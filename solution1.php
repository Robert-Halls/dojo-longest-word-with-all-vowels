<?php

function word_is_not_acceptable($word)
{
	return ! word_is_acceptable($word);
}

function word_is_acceptable($word)
{
	if (word_is_too_short($word)) {
		return false;
	}

	foreach (['a', 'e', 'i', 'o', 'u'] as $vowel) {
		if (word_doesnt_contain_only_one_occurence($word, $vowel)) {
			return false;
		}
	}

	return true;
}


function word_is_too_short($word)
{
	global $longestWordLength;

	return strlen($word) < $longestWordLength;
}

function word_doesnt_contain_only_one_occurence($word, $letter)
{
	return substr_count($word, $letter) !== 1;
}


function word_is_longer_than_the_previous_acceptable_word($word)
{
	global $longestWordLength;

	return strlen($word) > $longestWordLength;
}

function remove_previously_recorded_words()
{
	global $longestWords;

	$longestWords=[];
}

function record_new_longest_word_length($word)
{
	global $longestWordLength;

	$longestWordLength = strlen($word);
}

function record_acceptable_word($word)
{
	global $longestWords;

	$longestWords[] = $word;
}

$handle = fopen(__DIR__ . "/english-words/words_alpha.txt", "r");

if (!$handle) {
	exit('Could not open wordlist');
}

$longestWordLength = 0;
$longestWords = [];

if ($handle) {
	while (($word = fgets($handle)) !== false) {
	    $word = trim($word);
		if(word_is_not_acceptable($word)) {
			continue;
		}

		if(word_is_longer_than_the_previous_acceptable_word($word)) {
			remove_previously_recorded_words();	
			record_new_longest_word_length($word);
		}

		record_acceptable_word($word);

	}

	fclose($handle);
}

echo 'The length of the longest english word, containing each vowel only once is: ' . $longestWordLength . ' characters' . PHP_EOL;
echo 'The word(s) are:' .PHP_EOL;
echo implode(PHP_EOL, $longestWords);