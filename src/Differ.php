<?php

namespace Differ\Differ;

function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $firstFileContent = file_get_contents($firstFilePath);
    $secondFileContent = file_get_contents($secondFilePath);

    $decodedFirstFile = json_decode($firstFileContent, true);
    $decodedSecondFile = json_decode($secondFileContent, true);


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
        $result = "{\n{$finalString}\n}";
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
