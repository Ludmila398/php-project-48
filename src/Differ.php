<?php

namespace Differ\Differ;

use function Differ\Parsers\parseFile;
use function Differ\Formatter\formatFile;
use function Functional\sort;

function buildAST(mixed $decodedFirstFile, mixed $decodedSecondFile): mixed
{
    $firstFileKeys = array_keys($decodedFirstFile);
    $secondFileKeys = array_keys($decodedSecondFile);
    $bothFilesKeys = array_unique(array_merge($firstFileKeys, $secondFileKeys));
    $sortedFilesKeys = sort($bothFilesKeys, fn ($left, $right) => strcmp($left, $right));

    return array_map(function ($key) use ($decodedFirstFile, $decodedSecondFile) {
        $firstValue = $decodedFirstFile[$key] ?? null;
        $secondValue = $decodedSecondFile[$key] ?? null;

        if (is_array($firstValue) && is_array($secondValue)) {
            return ['status' => 'nested',
                'key' => $key,
                'firstValue' => buildAST($firstValue, $secondValue),
                'secondValue' => null];
        }

        if (!array_key_exists($key, $decodedFirstFile)) {
            return ['status' => 'added',
                'key' => $key,
                'firstValue' => $secondValue,
                'secondValue' => null];
        }

        if (!array_key_exists($key, $decodedSecondFile)) {
            return ['status' => 'deleted',
                'key' => $key,
                'firstValue' => $firstValue,
                'secondValue' => null];
        }

        if ($firstValue !== $secondValue) {
            return ['status' => 'changed',
                'key' => $key,
                'firstValue' => $firstValue,
                'secondValue' => $secondValue];
        }

        return ['status' => 'unchanged',
            'key' => $key,
            'firstValue' => $firstValue,
            'secondValue' => null];
    }, $sortedFilesKeys);
}

function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $decodedFirstFile = parseFile($firstFilePath);
    $decodedSecondFile = parseFile($secondFilePath);

    $diff = buildAST($decodedFirstFile, $decodedSecondFile);
    return formatFile($format, $diff);
}
