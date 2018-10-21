<?php

require_once 'Word.php';

class WordIterator extends SplFileObject
{
    public function current() : Word
    {
        return new Word(parent::current());
    }
}
