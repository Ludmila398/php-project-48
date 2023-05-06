<?php

namespace Differ\Formatter;

use function Differ\Formatters\Stylish\formatStylish;
use function Differ\Formatters\Plain\formatPlain;
use function Differ\Formatters\Json\formatJson;

function formatFile(string $format, mixed $diff): string
{
    if ($format === 'stylish') {
        return formatStylish($diff);
    } elseif ($format === 'plain') {
        return formatPlain($diff);
    } elseif ($format === 'json') {
        return formatJson($diff);
    } else {
        return "Invalid format!\n";
    }
}
