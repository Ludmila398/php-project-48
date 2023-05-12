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
        $this->assertEquals(
            genDiff("tests/fixtures/file1.json", "tests/fixtures/file2.json"),
            genDiff($firstJsonFilePath, $secondJsonFilePath)
        );
    }

    public function testStylishDiffer(): void
    {
        $testFilePath = __DIR__ . "/fixtures/TestResultFilesRecursiveStructure.txt";
        $expectedRecursiveResult = file_get_contents($testFilePath);
        $thirdJsonFilePath = __DIR__ . "/fixtures/file41.json";
        $fourthJsonFilePath = __DIR__ . "/fixtures/file42.json";
        $this->assertEquals($expectedRecursiveResult, genDiff($thirdJsonFilePath, $fourthJsonFilePath));
        $thirdYamlFilePath = __DIR__ . "/fixtures/file51.yaml";
        $fourthYamlFilePath = __DIR__ . "/fixtures/file52.yaml";
        $this->assertEquals($expectedRecursiveResult, genDiff($thirdYamlFilePath, $fourthYamlFilePath));
    }

    public function testPlainDiffer(): void
    {
        $thirdJsonFilePath = __DIR__ . "/fixtures/file41.json";
        $fourthJsonFilePath = __DIR__ . "/fixtures/file42.json";
        $PlainFilePath = __DIR__ . "/fixtures/TestResultFilesPlainFormat.txt";
        $expectedPlainResult = file_get_contents($PlainFilePath);
        $this->assertEquals($expectedPlainResult, genDiff($thirdJsonFilePath, $fourthJsonFilePath, 'plain'));
    }

    public function testJsonDiffer(): void
    {
        $thirdJsonFilePath = __DIR__ . "/fixtures/file41.json";
        $fourthJsonFilePath = __DIR__ . "/fixtures/file42.json";
        $JsonFilePath = __DIR__ . "/fixtures/TestResultFilesJsonFormat.txt";
        $expectedPlainResult = file_get_contents($JsonFilePath);
        $this->assertEquals($expectedPlainResult, genDiff($thirdJsonFilePath, $fourthJsonFilePath, 'json'));
    }
}
