<?php

namespace Analyzer\Exceptions;

use Throwable;

abstract class AbstractCustomException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    final protected function getExceptionMessage(string $message = ""): string
    {
        return strlen($message) ? $message : $this->getDefaultMessage();
    }

    abstract protected function getDefaultMessage(): string;
}
