<?php

namespace app\monitor;

use Throwable;

class MissingParamsException extends \Exception
{
    public function __construct(string $message = 'Please add (-f "filename") and (-p "saved storage")', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}