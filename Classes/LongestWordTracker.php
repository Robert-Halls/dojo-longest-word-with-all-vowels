<?php

require_once 'Word.php';

class LongestWordTracker
{
    /** @var Word[] */
    private $words = [];

    public function __construct()
    {
        $this->words[] = new Word('');
    }

    public function submit(Word $word)
    {
        switch (true)
        {
            case $word->isLongerThan($this->currentWord()):
                $this->replace($word);
                break;
            case $word->isTheSameLengthAs($this->currentWord()):
                $this->append($word);
                break;
            case $word->isShorterThan($this->currentWord()):
                $this->discard($word);
                break;
        }
    }

    private function currentWord()
    {
        return $this->words[0];
    }

    private function replace($word)
    {
        $this->words = [$word];
    }

    private function append($word)
    {
        $this->words[] = $word;
    }

    private function discard($word)
    {
        return;
    }

    public function print()
    {
        if ($this->currentWord() == '') {
            echo 'No words were added';
            return;
        }

        if (count($this->words)  == 1) {
            echo 'The longest word is ';
        } else {
            echo 'The longest words are ';
        }

        echo mb_strlen($this->currentWord()) . ' characters long:' . PHP_EOL;
        echo join(PHP_EOL, $this->words);
        echo PHP_EOL;
    }
}
