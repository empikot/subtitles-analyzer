<?php
namespace Analyzer\Services\SubtitleFile;

use Analyzer\Models\SubtitleFileInfo;

class Parser
{
    /**
     * @var ReaderInterface
     */
    private $reader;

    /**
     * Parser constructor.
     * @param ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param SubtitleFileInfo $subtitleFileInfo
     * @return array
     */
    public function getAllWordsWithoutSpecialCharacters(SubtitleFileInfo $subtitleFileInfo): array
    {
        $content = $this->reader->getFileContents($subtitleFileInfo);
        $content = $this->removeAllUnwantedCharacters($content);
        $content = trim($content);
        $wordsList = explode(" ", $content);
        return $this->removeWordsWithSpecialCharacters($wordsList);
    }

    /**
     * @param string $text
     * @return string
     * @todo what about apostrophe? for now i'm treating it as punctuation mark but is it correct?
     */
    private function removeAllUnwantedCharacters(string $text): string
    {
        $text = strip_tags($text);
        $charsToReplace = [
            "\r", "\n", "\t", ".", ",", "(", ")", "{", "}", "<", ">", ";", ":", "/", "\\", "'", "`", "?", "!", "*", "_", "-"
        ];
        return str_replace($charsToReplace, " ", $text);
    }

    /**
     * @param array $wordsList
     * @return array
     */
    private function removeWordsWithSpecialCharacters(array $wordsList): array
    {
        $keepedWords = [];
        foreach ($wordsList as $singleWord) {
            if (preg_match('/\b[A-Za-z]+\b/u', $singleWord, $wordMatch) && strlen($singleWord) > 0) {
                $keepedWords[] = reset($wordMatch);
            }
        }
        return $keepedWords;
    }
}