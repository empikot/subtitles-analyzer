<?php

namespace Analyzer\Services;

use Analyzer\Models\WordsCounter;

class CountedWordsSorter
{
    /**
     * @param WordsCounter $wordsCounter
     * @return array
     */
    public function sort(WordsCounter $wordsCounter): array
    {
        $countedWords = $wordsCounter->getCountedWords();
        uasort($countedWords, function (int $counter1, int $counter2) {
            return $counter2 <=> $counter1;
        });
        return $countedWords;
    }
}
