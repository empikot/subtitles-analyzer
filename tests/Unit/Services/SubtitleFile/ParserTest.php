<?php

namespace tests\Unit\Services\SubtitleFile;

use Analyzer\Models\SubtitleFileInfo;
use Analyzer\Services\SubtitleFile\Parser;
use Analyzer\Services\SubtitleFile\Reader;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @test
     */
    public function parsing_empty_text()
    {
        $this->performSingleTestCase(
            '',
            []
        );
    }

    /**
     * @test
     */
    public function parsing_text_with_single_word()
    {
        $this->performSingleTestCase(
            'test',
            ['test']
        );
    }

    /**
     * @test
     */
    public function parsing_text_with_multiple_words()
    {
        $this->performSingleTestCase(
            'test test',
            ['test', 'test']
        );

        $this->performSingleTestCase(
            'test anything test',
            ['test', 'anything', 'test']
        );
    }

    /**
     * @test
     */
    public function parsing_text_with_html_tags()
    {
        $this->performSingleTestCase(
            '<b>test</b> <i>another test</i>',
            ['test', 'another', 'test']
        );
    }

    /**
     * @test
     */
    public function parsing_text_with_special_characters()
    {
        $this->performSingleTestCase(
            'zażółć test gęślą test jaźń',
            ['test', 'test']
        );
    }

    /**
     * @test
     */
    public function parsing_text_in_multiple_lines_with_punctuation_marks_and_special_characters()
    {
        $this->performSingleTestCase(
            "00:00:00 --> !@#
            yo dawg! wassup?! what's up?
            i'm fine, just chilling out.
            true true! thisShouldBeCounted@#!%^&",
            ['yo', 'dawg', 'wassup', 'what', 's', 'up', 'i', 'm', 'fine', 'just', 'chilling', 'out', 'true', 'true', 'thisShouldBeCounted']
        );

        $this->performSingleTestCase(
            "www.google.com second-test
            testing (checking) another stuff!",
            ['www', 'google', 'com', 'second', 'test', 'testing', 'checking', 'another', 'stuff']
        );
    }

    private function performSingleTestCase(string $subtitleFileContents, array $expected)
    {
        // given
        $reader = \Mockery::mock(Reader::class);
        $reader->shouldReceive('getFileContents')->withAnyArgs()->andReturn($subtitleFileContents);
        $parser = new Parser($reader);

        // when
        $wordsList = $parser->getAllWordsWithoutSpecialCharacters(
            new SubtitleFileInfo('a', 'b', 'c')
        );

        // then
        $this->assertEquals($expected, $wordsList);
    }
}
