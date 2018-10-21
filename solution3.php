<?php

require_once 'vendor/autoload.php';

use Tightenco\Collect\Support\Collection;

$englishWords = new Collection(new SplFileObject(__DIR__ . "/english-words/words_alpha.txt"));

$solutions = $englishWords
    ->map(function ($word) {
        return trim($word);
    })
    ->filter(function ($word) {
        $word = strtolower($word);
        return substr_count($word, 'a') == 1
            && substr_count($word, 'e') == 1
            && substr_count($word, 'i') == 1
            && substr_count($word, 'o') == 1
            && substr_count($word, 'u') == 1;
    })
    ->groupBy(function ($word) {
        return strlen($word);
    })
    ->sortKeys()
    ->last();

if (empty($solutions)) {
    echo 'No words were added';
    exit;
}

if (count($solutions)  == 1) {
    echo 'The longest word is ';
} else {
    echo 'The longest words are ';
}

echo mb_strlen($solutions->first()) . ' characters long:' . PHP_EOL;
echo $solutions->implode(PHP_EOL);
echo PHP_EOL;