<?php

namespace  Analyzer\Exceptions;

class FailedToUploadException extends AbstractCustomException
{
    protected function getDefaultMessage(): string
    {
        return 'Failed to upload file';
    }
}
