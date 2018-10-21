<?php

class Word
{
    /** @var string */
    private $word;

    public function __construct(string $word)
    {
        $this->word = trim($word);
    }

    public function isLongerThan(string $word)
    {
        return mb_strlen($this->word) > mb_strlen($word);
    }

    public function isShorterThan(string $word)
    {
        return mb_strlen($this->word) < mb_strlen($word);
    }

    public function isTheSameLengthAs(string $word)
    {
        return mb_strlen($this->word) == mb_strlen($word);
    }

    public function containsEachVowelOnlyOnce() : bool
    {
        $word = strtolower($this->word);

        return substr_count($word, 'a') == 1
            && substr_count($word, 'e') == 1
            && substr_count($word, 'i') == 1
            && substr_count($word, 'o') == 1
            && substr_count($word, 'u') == 1
            ;
    }

    public function __toString()
    {
        return $this->word;
    }
}
