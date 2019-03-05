<?php
namespace Analyzer\Services\SubtitleFile;

use Analyzer\Models\SubtitleFileInfo;
use Analyzer\Services\SubtitleFile\ParseHandle\StrategyInterface;

class Parser
{
    /**
     * @var ReaderInterface
     */
    private $reader;
    /**
     * @var StrategyInterface
     */
    private $parseHandle;

    /**
     * Parser constructor.
     * @param ReaderInterface $reader
     * @param StrategyInterface $parseHandle
     */
    public function __construct(ReaderInterface $reader, StrategyInterface $parseHandle)
    {
        $this->reader = $reader;
        $this->parseHandle = $parseHandle;
    }

    /**
     * @param SubtitleFileInfo $subtitleFileInfo
     * @return array
     */
    public function getAllWordsWithoutSpecialCharacters(SubtitleFileInfo $subtitleFileInfo): array
    {
        $content = $this->reader->getFileContents($subtitleFileInfo);
        $content = $this->parseHandle->removeAllUnwantedCharacters($content);
        $words = $this->parseHandle->splitIntoWords($content);
        return $this->parseHandle->cleanupWordsList($words);
    }
}
