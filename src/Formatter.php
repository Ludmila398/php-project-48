<?php

namespace Differ\Formatter;

use function Differ\Formatters\Stylish\formatStylish;

function formatFile(string $format, mixed $diff): string
{
    if ($format === 'stylish') {
        return formatStylish($diff);
    } else {
        return "Invalid format!\n";
    }
}
