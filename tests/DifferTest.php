<?php

namespace Differ\DifferTest;
use function Differ\Differ\genDiff;

use PHPUnit\Framework\TestCase;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $firstFilePath = __DIR__ . "/fixtures/file1.json";
        $secondFilePath = __DIR__ . "/fixtures/file2.json";
        $this->assertIsString(genDiff($firstFilePath, $secondFilePath));
        $this->assertEquals(genDiff("tests/fixtures/file1.json", "tests/fixtures/file2.json"), 
        genDiff($firstFilePath, $secondFilePath));
    }
}