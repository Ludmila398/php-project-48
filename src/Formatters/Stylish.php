<?php

namespace Differ\Formatters\Stylish;

function convertBoolToString(mixed $value): mixed
{
    return (!is_bool($value) ? $value : ($value ? 'true' : 'false'));
}

function formatStylish(mixed $array, int $spacesCount = 0): string
{
    $stringBeginning = str_repeat('    ', $spacesCount);
    $formattedArray = array_map(function ($destructuredArray) use ($stringBeginning, $spacesCount) {

        $status = $destructuredArray['status'];
        $key = $destructuredArray['key'];
        $firstOriginalValue = $destructuredArray['firstValue'];
        $secondOriginalValue = $destructuredArray['secondValue'];

        $stringifyFirstValue = stringify($firstOriginalValue, $spacesCount + 1);

        $firstValue = convertBoolToString($firstOriginalValue);
        $secondValue = convertBoolToString($secondOriginalValue);
        switch ($status) {
            case 'nested':
                $nestedValue = is_array($firstValue)
                ? formatStylish($firstValue, $spacesCount + 1) : stringify($firstValue);
                return "$stringBeginning    $key: $nestedValue";
            case 'unchanged':
                return "$stringBeginning    $key: $stringifyFirstValue";
            case 'added':
                return "$stringBeginning  + $key: $stringifyFirstValue";
            case 'deleted':
                return "$stringBeginning  - $key: $stringifyFirstValue";
            case 'changed':
                $stringifySecondValue = stringify($secondValue, $spacesCount + 1);
                return
                "$stringBeginning  - $key: $stringifyFirstValue\n $stringBeginning + $key: $stringifySecondValue";
            default:
                return null;
        };
    }, $array);

    $result = ["{", ...$formattedArray, "$stringBeginning}"];
    return implode("\n", $result);
}

function stringify(mixed $value, int $spacesCount = 1): string
{
    $iter = function ($currentValue, $depth) use (&$iter, $spacesCount) {
        if (!is_array($currentValue)) {
            if ($currentValue === null) {
                return 'null';
            }
            return trim(var_export($currentValue, true), "'");
        }

        $indentSize = $depth * $spacesCount;
        $indent = str_repeat('    ', $indentSize);

        $lines = array_map(
            fn($key, $val) => "$indent    $key: {$iter($val, $depth + 1)}",
            array_keys($currentValue),
            $currentValue
        );

        $result = ['{', ...$lines, "$indent}"];

        return implode("\n", $result);
    };

    return $iter($value, 1);
}
