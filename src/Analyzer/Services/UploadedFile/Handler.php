<?php

namespace Analyzer\Services\UploadedFile;

use Analyzer\Exceptions\FailedToUploadException;
use Analyzer\Exceptions\NoSubtitleFileWasUploadedException;
use Analyzer\Models\SubtitleFileInfo;
use Analyzer\Services\SubtitleFile\Builder;
use Slim\Http\Request;
use Slim\Http\UploadedFile;

class Handler
{
    const INPUT_NAME_SUBTITLE_FILE = 'subtitle';

    /**
     * @var Builder
     */
    private $subtitleFileBuilder;

    /**
     * Handler constructor.
     * @param Builder $subtitleFileBuilder
     */
    public function __construct(Builder $subtitleFileBuilder)
    {
        $this->subtitleFileBuilder = $subtitleFileBuilder;
    }

    /**
     * @param Request $request
     * @return SubtitleFileInfo
     * @throws FailedToUploadException
     * @throws NoSubtitleFileWasUploadedException
     */
    public function getUploadedFileInfo(Request $request): SubtitleFileInfo
    {
        $uploadedFile = $this->getUploadedFileFromRequest($request);
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            return $this->subtitleFileBuilder->build($uploadedFile);
        }
        throw new FailedToUploadException();
    }

    private function getUploadedFileFromRequest(Request $request): UploadedFile
    {
        $uploadedFiles = $request->getUploadedFiles();
        if ($this->hasSubtitleFileBeenUploaded($uploadedFiles)) {
            return $uploadedFiles[self::INPUT_NAME_SUBTITLE_FILE];
        }
        throw new NoSubtitleFileWasUploadedException();
    }

    private function hasSubtitleFileBeenUploaded(array $uploadedFiles): bool
    {
        return count($uploadedFiles) === 1
            && array_key_exists(self::INPUT_NAME_SUBTITLE_FILE, $uploadedFiles);
    }
}
