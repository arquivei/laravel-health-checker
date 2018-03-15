<?php

namespace Laravel\Health\Exceptions;

use Throwable;

class LoaderFailureException extends \Exception
{
    public function __construct(
        string $message = 'Unsuccessfully load the health manager.',
        int $code = 0,
        Throwable $previous = null
    ){
        parent::__construct($message, $code, $previous);
    }
}
