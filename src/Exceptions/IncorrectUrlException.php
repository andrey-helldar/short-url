<?php

namespace Helldar\ShortUrl\Exceptions;

use Exception;

class IncorrectUrlException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message, 400);
    }
}
