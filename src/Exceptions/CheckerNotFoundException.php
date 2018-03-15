<?php

namespace Laravel\Health\Exceptions;

use Throwable;

class CheckerNotFoundException extends \Exception
{
    public function __construct(
        string $message = 'Checker not found. Check your health-checker config file in services section.',
        int $code = 0,
        Throwable $previous = null
    ){
        parent::__construct($message, $code, $previous);
    }
}
