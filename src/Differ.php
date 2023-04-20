<?php

namespace Differ\Differ;

use function Differ\Parsers\parseFile; 

function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{

    $decodedFirstFile = parseFile($firstFilePath);
    $decodedSecondFile = parseFile($secondFilePath);

    $mergedArr = array_merge($decodedFirstFile, $decodedSecondFile);
    ksort($mergedArr);
    $arrDiff = [];
    foreach ($mergedArr as $key => $value) {
        if ((array_key_exists($key, $decodedSecondFile)) && (array_key_exists($key, $decodedFirstFile))
            && ($decodedFirstFile[$key] !== $decodedSecondFile[$key])) {
            $arrDiff[] = ['-', $key, ':', $decodedFirstFile[$key]];
            $arrDiff[] = ['+', $key, ':', $value];
        } elseif (!array_key_exists($key, $decodedSecondFile)) {
            $arrDiff[] = ['-', $key, ':', $value];
        } elseif ((array_key_exists($key, $decodedSecondFile) && (array_key_exists($key, $decodedFirstFile))
            && ($decodedFirstFile[$key] === $decodedSecondFile[$key]))) {
            $arrDiff[] = [' ', $key, ':', $value];
        } elseif (!array_key_exists($key, $decodedFirstFile)) {
            $arrDiff[] = ['+', $key, ':', $value];
        }
    }

    $result = '';
    $finalString = '';

    foreach ($arrDiff as $subArray) {
        $subArray[3] = convertBoolToString($subArray[3]);
        $string = implode(' ', $subArray);
        $finalString = "{$finalString}{$string}\n";
        $result = "{\n{$finalString}}";
    }
    return $result;
}

function convertBoolToString($value)
{
    return (!is_bool($value) ? $value : ($value ? 'true' : 'false'));
}

function getFixtureFullPath($fixtureName) //// абс.путь к файлам
{
    $parts = [__DIR__, 'fixtures', $fixtureName];
    return realpath(implode('/', $parts));
}
