<?php

namespace Differ\Formatters\Json;

function formatJson(mixed $array): string
{
    return json_encode($array, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
}
