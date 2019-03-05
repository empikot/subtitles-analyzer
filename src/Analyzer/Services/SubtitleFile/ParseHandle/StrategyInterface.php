<?php

namespace Analyzer\Services\SubtitleFile\ParseHandle;

interface StrategyInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function removeAllUnwantedCharacters(string $text): string;

    /**
     * @param string $text
     * @return array
     */
    public function splitIntoWords(string $text): array;

    /**
     * @param array $words
     * @return array
     */
    public function cleanupWordsList(array $words): array;
}
