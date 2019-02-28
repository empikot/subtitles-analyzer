<?php

namespace tests\Unit\Services\SubtitleFile;

use Analyzer\Models\SubtitleFileInfo;
use Analyzer\Services\SubtitleFile\Analyzer;
use Analyzer\Services\SubtitleFile\Parser;
use PHPUnit\Framework\TestCase;

class AnalyzerTest extends TestCase
{
    /**
     * @test
     */
    public function counting_empty_words_list()
    {
        $this->performSingleTestCase(
            [],
            []
        );
    }

    /**
     * @test
     */
    public function counting_words_list_with_single_word()
    {
        $this->performSingleTestCase(
            ['a'],
            ['a' => 1]
        );
    }

    /**
     * @test
     */
    public function counting_words_list_with_multiple_words()
    {
        $this->performSingleTestCase(
            ['a', 'b', 'c', 'b'],
            ['a' => 1, 'b' => 2, 'c' => 1]
        );
    }

    private function performSingleTestCase(array $wordsList, array $expected)
    {
        // given
        $parser = \Mockery::mock(Parser::class);
        $parser->shouldReceive('getAllWordsWithoutSpecialCharacters')->withAnyArgs()->andReturn($wordsList);
        $analyzer = new Analyzer($parser);

        // when
        $wordsCounter = $analyzer->countWords(
            new SubtitleFileInfo('a', 'b', 'c')
        );

        // then
        $this->assertEquals($expected, $wordsCounter->getCountedWords());
    }
}
