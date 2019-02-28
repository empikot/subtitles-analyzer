<?php

namespace Analyzer\Services\SubtitleFile;

use Analyzer\Models\SubtitleFileInfo;
use Slim\Http\UploadedFile;

class Builder
{
    /**
     * @param UploadedFile $uploadedFile
     * @return SubtitleFileInfo
     */
    public function build(UploadedFile $uploadedFile): SubtitleFileInfo
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = pathinfo($uploadedFile->getClientFilename(), PATHINFO_BASENAME);
        return new SubtitleFileInfo(
            $uploadedFile->file,
            $basename,
            $extension
        );
    }
}
