<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parseFile(string $filePath)
{
    $fileContent = file_get_contents($filePath);

    if (pathinfo($filePath, PATHINFO_EXTENSION) === 'json') {
        $decodedFile = json_decode($fileContent, true);
    } else {
        $decodedFile = Yaml::parse($fileContent); ////Yaml::PARSE_OBJECT_FOR_MAP
    }
    return $decodedFile;
}
