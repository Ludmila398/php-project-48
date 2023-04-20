<?php

namespace Differ\DifferTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDiffer(): void
    {
        $firstJsonFilePath = __DIR__ . "/fixtures/file1.json";
        $secondJsonFilePath = __DIR__ . "/fixtures/file2.json";
        $this->assertIsString(genDiff($firstJsonFilePath, $secondJsonFilePath));
        $this->assertEquals(genDiff("tests/fixtures/file1.json", "tests/fixtures/file2.json"),
        genDiff($firstJsonFilePath, $secondJsonFilePath));

        $testFilePath = __DIR__ . "/fixtures/TestResultFlatFiles.txt";
        $expectedResult = file_get_contents($testFilePath);
        $this->assertEquals($expectedResult, genDiff($firstJsonFilePath, $secondJsonFilePath));

        $firstYmlFilePath = __DIR__ . "/fixtures/file21.yml";
        $secondYmlFilePath = __DIR__ . "/fixtures/file22.yml";
        $this->assertEquals($expectedResult, genDiff($firstYmlFilePath, $secondYmlFilePath));

        $firstYamlFilePath = __DIR__ . "/fixtures/file31.yaml";
        $secondYamlFilePath = __DIR__ . "/fixtures/file32.yaml";
        $this->assertEquals($expectedResult, genDiff($firstYmlFilePath, $secondYmlFilePath));
    }
}
