<?php

namespace Analyzer\Services\SubtitleFile\ParseHandle;

class NoWordsWithSpecialCharsStrategy implements StrategyInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function removeAllUnwantedCharacters(string $text): string
    {
        $text = strip_tags($text);
        $charsToReplace = [
            "\r", "\n", "\t", ".", ",", "(", ")", "{", "}", "<", ">", ";", ":",
            "/", "\\", "'", "`", "?", "!", "*", "_", "-", '"', "[", "]", "|"
        ];
        $text = str_replace($charsToReplace, " ", $text);
        return trim($text);
    }

    /**
     * @param string $text
     * @return array
     */
    public function splitIntoWords(string $text): array
    {
        return explode(" ", $text);
    }

    /**
     * @param array $words
     * @return array
     */
    public function cleanupWordsList(array $words): array
    {
        $keepedWords = [];
        foreach ($words as $word) {
            if (preg_match('/\b[A-Za-z]+\b/u', $word, $wordMatch) && strlen($word) > 0) {
                $keepedWords[] = reset($wordMatch);
            }
        }
        return $keepedWords;
    }
}
