<?php

namespace Helldar\ShortUrl\Exceptions;

class IncorrectUrlException extends \Exception
{
    public function __construct(string $url)
    {
        $message = \sprintf('Incorrect URL: %s', $url);

        parent::__construct($message, 400);
    }
}