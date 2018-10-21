<?php

require_once 'Classes/Word.php';
require_once 'Classes/WordIterator.php';
require_once 'Classes/LongestWordTracker.php';

$englishWords = new WordIterator(__DIR__ . "/english-words/words_alpha.txt");
$longestWords = new LongestWordTracker;

foreach ($englishWords as $word) {
    if ($word->containsEachVowelOnlyOnce()) {
        $longestWords->submit($word);
    }
}

$longestWords->print();
