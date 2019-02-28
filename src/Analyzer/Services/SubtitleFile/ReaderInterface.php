<?php

namespace Analyzer\Services\SubtitleFile;

use Analyzer\Models\SubtitleFileInfo;

interface ReaderInterface
{
    public function getFileContents(SubtitleFileInfo $subtitleFile): string;
}
