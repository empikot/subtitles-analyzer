<?php

namespace  Analyzer\Exceptions;

class FileDoesNotExistException extends AbstractCustomException
{
    protected function getDefaultMessage(): string
    {
        return 'SubtitleFile does not exist';
    }
}
