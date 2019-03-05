<?php

namespace tests\Unit\Services\SubtitleFile\ParseHandle;

use Analyzer\Services\SubtitleFile\ParseHandle\NoSpecialCharsExceptDiacriticsStrategy;
use PHPUnit\Framework\TestCase;

class NoSpecialCharsExceptDiacriticsStrategyTest extends TestCase
{
    /**
     * @var NoSpecialCharsExceptDiacriticsStrategy
     */
    private $parseHandle;

    public function setUp()
    {
        parent::setUp();
        $this->parseHandle = new NoSpecialCharsExceptDiacriticsStrategy();
    }

    /**
     * @test
     */
    public function removing_unwanted_characters()
    {
        $this->assertEquals(
            '',
            $this->parseHandle->removeAllUnwantedCharacters('')
        );

        $this->assertEquals(
            'test',
            $this->parseHandle->removeAllUnwantedCharacters('<b>test</b>')
        );

        $this->assertEquals(
            'test aaa test done',
            $this->parseHandle->removeAllUnwantedCharacters('{[(test)]} ; "aaa" \'test\' , . done')
        );
    }

    /**
     * @test
     */
    public function splitting_into_words()
    {
        $this->assertEquals(
            [''],
            $this->parseHandle->splitIntoWords('')
        );

        $this->assertEquals(
            ['test'],
            $this->parseHandle->splitIntoWords('test')
        );

        $this->assertEquals(
            ['test', 'done'],
            $this->parseHandle->splitIntoWords('test done')
        );
    }

    /**
     * @test
     */
    public function cleaning_up_words_list()
    {
        $this->assertEquals(
            [],
            $this->parseHandle->cleanupWordsList([''])
        );

        $this->assertEquals(
            ['test'],
            $this->parseHandle->cleanupWordsList(['test'])
        );

        $this->assertEquals(
            ['test', 'done'],
            $this->parseHandle->cleanupWordsList(['test', 'done'])
        );

        $this->assertEquals(
            ['test', 'zażółć', 'kotek', 'im', 'done'],
            $this->parseHandle->cleanupWordsList(['test', 'zażółć', 'kot\'ek', 'i\'m', 'done'])
        );
    }
}
