<?php

namespace tests\Unit\Services\SubtitleFile;

use Analyzer\Models\WordsCounter;
use Analyzer\Services\CountedWordsSorter;
use PHPUnit\Framework\TestCase;

class CountedWordsSorterTest extends TestCase
{
    /**
     * @test
     */
    public function sorting_empty_list()
    {
        $this->performSingleTestCase(
            [],
            []
        );
    }

    /**
     * @test
     */
    public function sorting_list_with_one_word()
    {
        $this->performSingleTestCase(
            ['a' => 1],
            ['a' => 1]
        );
    }

    /**
     * @test
     */
    public function sorting_list_with_more_than_one_word()
    {
        $this->performSingleTestCase(
            ['a' => 2, 'b' => 1],
            ['a' => 2, 'b' => 1]
        );

        $this->performSingleTestCase(
            ['a' => 1, 'b' => 2],
            ['b' => 2, 'a' => 1]
        );

        $this->performSingleTestCase(
            ['a' => 1, 'b' => 1],
            ['a' => 1, 'b' => 1]
        );
    }
    
    private function performSingleTestCase(array $countedWords, array $expected)
    {
        // given
        $wordsCounter = \Mockery::mock(WordsCounter::class);
        $wordsCounter->shouldReceive('getCountedWords')->withAnyArgs()->andReturn($countedWords);
        $sorter = new CountedWordsSorter();

        // when
        $sortedWords = $sorter->sort($wordsCounter);

        // then
        $this->assertEquals($expected, $sortedWords);
    }
}
