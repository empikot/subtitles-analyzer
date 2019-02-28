<?php

namespace  Analyzer\Exceptions;

class NoSubtitleFileWasUploadedException extends AbstractCustomException
{
    protected function getDefaultMessage(): string
    {
        return 'No subtitle file was uploaded';
    }
}
