<?php

namespace Laravel\Health\Exceptions;

use Throwable;

class EmptyConfigException extends \Exception
{
    public function __construct(
        string $message = 'The config array cannot be empty',
        int $code = 0,
        Throwable $previous = null
    ){
        parent::__construct($message, $code, $previous);
    }
}
