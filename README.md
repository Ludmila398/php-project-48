### Hexlet tests and linter status:
[![Actions Status](https://github.com/Ludmila398/php-project-48/workflows/hexlet-check/badge.svg)](https://github.com/Ludmila398/php-project-48/actions)

### Github Actions
[![PHP Linter and Tests](https://github.com/Ludmila398/php-project-diff-generator/actions/workflows/main.yml/badge.svg)](https://github.com/Ludmila398/php-project-diff-generator/actions/workflows/main.yml)

### Codeclimate Maintainability Badge
[![Maintainability](https://api.codeclimate.com/v1/badges/13bd7859279f11041dc4/maintainability)](https://codeclimate.com/github/Ludmila398/php-project-diff-generator/maintainability)

### Codeclimate Test Coverage Badge
[![Test Coverage](https://api.codeclimate.com/v1/badges/13bd7859279f11041dc4/test_coverage)](https://codeclimate.com/github/Ludmila398/php-project-diff-generator/test_coverage)

## Project description
A diff generator is a program that determines the difference between two data structures. This mechanism is often used when displaying test results or automatically tracking changes in configuration files.

Features of the utility:

- Supports various input formats: YAML and JSON
- Generates reports in plain text, stylish, and JSON formats

## Requirements
- PHP >= 8.1
- Composer

## Installation

Clone the repo and enter the project folder:
```
git clone git@github.com:Ludmila398/php-project-diff-generator.git

cd php-project-diff-generator
```
Install dependencies using Composer.
Ensure that `make` is installed and available on your system. The `make install` command will use Composer to install dependencies and prepare the project:
```
make install
```
Make sure the files in bin/ have execute permissions:
```
chmod +x bin/gendiff
```

## Options
-h --help Show options

-v --version Show version

--format <fmt>  Report format [default: stylish]

## Running the Program
```
./bin/gendiff -h

./bin/gendiff -v

./bin/gendiff [--format <fmt>] <firstFile> <secondFile>
```
```
./bin/gendiff ./tests/fixtures/file1.json ./tests/fixtures/file2.json --format json

./bin/gendiff ./tests/fixtures/file21.yml ./tests/fixtures/file22.yml --format stylish

./bin/gendiff ./tests/fixtures/file41.json ./tests/fixtures/file42.json --format plain
```

### asciinema.org ./bin/gendiff comparing json files:
[![asciicast](https://asciinema.org/a/tLwZk2AN09kjQDemsZ6CdEPjx.svg)](https://asciinema.org/a/tLwZk2AN09kjQDemsZ6CdEPjx)

### asciinema.org ./bin/gendiff comparing yaml files:
[![asciicast](https://asciinema.org/a/Vih2GPNGo34FCWmXS0c1fpVFc.svg)](https://asciinema.org/a/Vih2GPNGo34FCWmXS0c1fpVFc)

### asciinema.org ./bin/gendiff comparing json files, format "stylish":
[![asciicast](https://asciinema.org/a/kQNnqMcnsBvt4ZYZap1qVc8DE.svg)](https://asciinema.org/a/kQNnqMcnsBvt4ZYZap1qVc8DE)

### asciinema.org ./bin/gendiff comparing json files, format "plain":
[![asciicast](https://asciinema.org/a/Iwh3qrDJd1S5GFtQ6V9mLuzs5.svg)](https://asciinema.org/a/Iwh3qrDJd1S5GFtQ6V9mLuzs5)

### asciinema.org ./bin/gendiff comparing json files, format "json":
[![asciicast](https://asciinema.org/a/8TpP8hEnRkEX3xbNm64Zr8RBP.svg)](https://asciinema.org/a/8TpP8hEnRkEX3xbNm64Zr8RBP)