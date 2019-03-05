<?php

namespace Analyzer\Services\SubtitleFile\ParseHandle;

class NoSpecialCharsExceptDiacriticsStrategy implements StrategyInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function removeAllUnwantedCharacters(string $text): string
    {
        $text = strip_tags($text);
        $charsToReplace = [
            ".", ",", "(", ")", "{", "}", "<", ">", ";", ":", "/", "\\", "'", "`", "?", "!", "_", "-", '"', "[", "]", "|"
        ];
        $text = str_replace($charsToReplace, " ", $text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = preg_replace('/[0-9]+/', '', $text);
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
            if (strlen($word) > 0) {
                $keepedWords[] = preg_replace('/[^\w]/u', '', $word);
            }
        }
        return $keepedWords;
    }
}
