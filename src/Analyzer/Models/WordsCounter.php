<?php

namespace Analyzer\Models;

class WordsCounter
{
    /**
     * @var array
     */
    private $countedWords;

    /**
     * WordsCounter constructor.
     */
    public function __construct()
    {
        $this->countedWords = [];
    }

    /**
     * @return array
     */
    public function getCountedWords(): array
    {
        return $this->countedWords;
    }

    /**
     * @param string $word
     */
    public function countWord(string $word)
    {
        $word = strtolower($word);
        if (!$this->hasAlreadyStartedCounting($word)) {
            $this->startCounting($word);
        }
        $this->incrementWordCounter($word);
    }

    /**
     * @param string $word
     * @return bool
     */
    private function hasAlreadyStartedCounting(string $word): bool
    {
        return isset($this->countedWords[$word]);
    }

    /**
     * @param string $word
     */
    private function startCounting(string $word)
    {
        $this->countedWords[$word] = 0;
    }

    /**
     * @param string $word
     */
    private function incrementWordCounter(string $word)
    {
        $this->countedWords[$word]++;
    }
}