<?php

namespace Differ\Formatters\Plain;

function formatPlain(mixed $array): string
{
    $result = function (array $node, string $previousKeys = '') use (&$result) {
        $mappedArray = array_map(function ($value) use ($result, $previousKeys) {
           
            $status = $value['status'];
            $key = $value['key'];
            $firstValue = $value['firstValue'];
            $secondValue = $value['secondValue'];

            $currentKeyPath = $previousKeys === '' ? $key : "$previousKeys.$key";

            switch ($status) {
                case 'nested':
                    return $result($firstValue, $currentKeyPath);
                case 'added':
                    $normalizeValue = getNormalizedValue($firstValue);
                    return "Property '$currentKeyPath' was added with value: $normalizeValue";
                case 'deleted':
                    return "Property '$currentKeyPath' was removed";
                case 'changed':
                    $normalizeValue1 = getNormalizedValue($firstValue);
                    $normalizeValue2 = getNormalizedValue($secondValue);
                    return "Property '$currentKeyPath' was updated. From $normalizeValue1 to $normalizeValue2";
                case 'unchanged':
                    break;
                default:
                    return null;
            }
            return null;
        }, $node);

        $filteredArray = array_filter($mappedArray);
        return implode("\n", $filteredArray);
    };

    return $result($array);
}


function getNormalizedValue(mixed $value): string
{
    if ($value === null) {
        return 'null';
    }

    if (is_array($value)) {
        return "[complex value]";
    }

    if (is_string($value)) {
        return "'$value'";
    }

    return trim(var_export($value, true), "'");
}
