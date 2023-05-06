<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $filePath)
{
    $fileContent = file_get_contents($filePath, false, null, 0);

    if ($fileContent !== false) {
        if (pathinfo($filePath, PATHINFO_EXTENSION) === 'json') {
            $decodedFile = json_decode($fileContent, true);
        } else {
        $decodedFile = Yaml::parse($fileContent);
        }
    return $decodedFile;
    }
}
