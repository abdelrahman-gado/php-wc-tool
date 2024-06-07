<?php

function getCommandArgument(array $args): array
{
    return array_slice($args, 1);
}

function getFileSize($file): int
{
    if (is_resource($file)) {
        return fstat($file)['size'];
    }
    return filesize($file);
}

function countFileLines($file): int
{
    $lineCount = 0;
    $handle = is_resource($file) ? $file : fopen($file, 'r');
    while (($line = fgets($handle)) !== false) {
        $lineCount++;
    }
    fclose($handle);

    return $lineCount;
}

function countFileWords($file): int
{
    $wordCount = 0;
    $handle = is_resource($file) ? $file : fopen($file, 'r');
    while (($line = fgets($handle)) !== false) {
        $wordCount += count(explode(' ', $line));
    }
    fclose($handle);

    return $wordCount;
}

function countCharacter($file): int
{
    $characterCount = 0;
    $handle = is_resource($file) ? $file : fopen($file, 'r');
    while ($ch = fgetc($handle) !== false) {
        $characterCount++;
    }
    fclose($handle);

    return $characterCount;
}

function output(...$outputs): void
{
    $lastIndex = count($outputs) - 1;
    if (is_resource($outputs[$lastIndex])) {
        $outputs[$lastIndex] = '';
    }

    echo implode(' ', $outputs);
}

$args = getCommandArgument($argv);
$argsCount = count($args);


if ($argsCount > 1) {
    $switch = $args[0];
    $file = $args[1];
} else {
    if (preg_match('/-+/', $args[0])) {
        $file = STDIN;
        $switch = $args[0] ?? false;
    } else {
        $file = $args[0];
        $switch = false;
    }
}

match ($switch) {
    '-i' => output(getFileSize($file), $file),
    '-l' => output(countFileLines($file), $file),
    '-w' => output(countFileWords($file), $file),
    '-m' => output(countCharacter($file), $file),
    default => output(countFileLines($file), countFileWords($file), getFileSize($file), $file)
};
