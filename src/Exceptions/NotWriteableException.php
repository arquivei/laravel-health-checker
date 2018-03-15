<?php

namespace Laravel\Health\Exceptions;

use Throwable;

class NotWriteableException extends \Exception
{

    protected $directory;

    public function __construct(
        string $directory,
        string $message,
        int $code = 0,
        Throwable $previous = null
    ){
        $this->directory = $directory;
        parent::__construct(sprintf($message, $directory), $code, $previous);
    }

    public function getDirectory()
    {
        return $this->directory;
    }
}
