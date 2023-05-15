<?php

namespace Differ\DifferTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    public function testDifferPaths(): void
    {
        $firstJsonFilePath = __DIR__ . "/fixtures/file1.json";
        $secondJsonFilePath = __DIR__ . "/fixtures/file2.json";
        $this->assertIsString(genDiff($firstJsonFilePath, $secondJsonFilePath));
        $this->assertEquals(
            genDiff("tests/fixtures/file1.json", "tests/fixtures/file2.json"),
            genDiff($firstJsonFilePath, $secondJsonFilePath)
        );
    }

    /**
    * @dataProvider genDiffProvider
    */
    public function testDiffer(
        string $firstFilePath,
        string $secondFilePath,
        string $expectedResultPath,
        string $format
    ): void {
        $expectedResult = file_get_contents($expectedResultPath);
        $this->assertEquals($expectedResult, genDiff($firstFilePath, $secondFilePath, $format));
    }

    public function genDiffProvider(): mixed
    {
        $fixturesPath = __DIR__ . "";

        return [
            'stylish json'  => [
                $fixturesPath . "/fixtures/file41.json",
                $fixturesPath . "/fixtures/file42.json",
                $fixturesPath . "/fixtures/TestResultFilesRecursiveStructure.txt",
                'stylish'
            ],

            'stylish yaml'  => [
                $fixturesPath . "/fixtures/file51.yaml",
                $fixturesPath . "/fixtures/file52.yaml",
                $fixturesPath . "/fixtures/TestResultFilesRecursiveStructure.txt",
                'stylish'
            ],
            'plain json'  => [
                $fixturesPath . "/fixtures/file41.json",
                $fixturesPath . "/fixtures/file42.json",
                $fixturesPath . "/fixtures/TestResultFilesPlainFormat.txt",
                'plain'
            ],
            'plain yaml'  => [
                $fixturesPath . "/fixtures/file51.yaml",
                $fixturesPath . "/fixtures/file52.yaml",
                $fixturesPath . "/fixtures/TestResultFilesPlainFormat.txt",
                'plain'
            ],
            'json json'  => [
                $fixturesPath . "/fixtures/file41.json",
                $fixturesPath . "/fixtures/file42.json",
                $fixturesPath . "/fixtures/TestResultFilesJsonFormat.txt",
                'json'
            ],
            'json yaml'  => [
                $fixturesPath . "/fixtures/file51.yaml",
                $fixturesPath . "/fixtures/file52.yaml",
                $fixturesPath . "/fixtures/TestResultFilesJsonFormat.txt",
                'json'
            ],

        ];
    }
}
