<?php

namespace Differ\Formatter;

use function Differ\Formatters\Stylish\formatStylish;
use function Differ\Formatters\Plain\formatPlain;

function formatFile(string $format, mixed $diff): string
{
    if ($format === 'stylish') {
        return formatStylish($diff);
    } elseif ($format === 'plain') {
        return formatPlain($diff);    
    } else {
        return "Invalid format!\n";
    }
}
