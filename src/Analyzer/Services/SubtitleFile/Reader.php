<?php

namespace Analyzer\Services\SubtitleFile;

use Analyzer\Exceptions\FileDoesNotExistException;
use Analyzer\Models\SubtitleFileInfo;

class Reader implements ReaderInterface
{
    /**
     * @param SubtitleFileInfo $subtitleFile
     * @return string
     * @throws FileDoesNotExistException
     */
    public function getFileContents(SubtitleFileInfo $subtitleFile): string
    {
        if (file_exists($subtitleFile->getPathToFile())) {
            return file_get_contents($subtitleFile->getPathToFile());
        }
        throw new FileDoesNotExistException();
    }
}
