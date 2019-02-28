<?php

namespace Analyzer\Services\SubtitleFile;

use Analyzer\Models\SubtitleFileInfo;
use Analyzer\Models\WordsCounter;

class Analyzer
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * Analyzer constructor.
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param SubtitleFileInfo $subtitleFileInfo
     * @return WordsCounter
     */
    public function countWords(SubtitleFileInfo $subtitleFileInfo): WordsCounter
    {
        $words = $this->parser->getAllWordsWithoutSpecialCharacters($subtitleFileInfo);
        $wordsCounter = new WordsCounter();
        array_walk(
            $words,
            function (string $word) use ($wordsCounter) {
                $wordsCounter->countWord($word);
            }
        );
        return $wordsCounter;
    }
}
