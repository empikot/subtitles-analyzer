<?php

namespace test\Unit\Models;

use Analyzer\Models\WordsCounter;
use PHPUnit\Framework\TestCase;

class WordsCounterTest extends TestCase
{
    /**
     * @test
     */
    public function counting_words()
    {
        $wordsCounter = new WordsCounter();
        $wordsCounter->countWord('a');
        $this->assertEquals(1, count($wordsCounter->getCountedWords()));
        $this->assertEquals(['a' => 1], $wordsCounter->getCountedWords());

        $wordsCounter->countWord('b');
        $this->assertEquals(2, count($wordsCounter->getCountedWords()));
        $this->assertEquals(['a' => 1, 'b' => 1], $wordsCounter->getCountedWords());

        $wordsCounter->countWord('b');
        $this->assertEquals(2, count($wordsCounter->getCountedWords()));
        $this->assertEquals(['a' => 1, 'b' => 2], $wordsCounter->getCountedWords());

        $wordsCounter->countWord('c');
        $this->assertEquals(3, count($wordsCounter->getCountedWords()));
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 1], $wordsCounter->getCountedWords());

        $wordsCounter->countWord('a');
        $this->assertEquals(3, count($wordsCounter->getCountedWords()));
        $this->assertEquals(['a' => 2, 'b' => 2, 'c' => 1], $wordsCounter->getCountedWords());
    }
}
