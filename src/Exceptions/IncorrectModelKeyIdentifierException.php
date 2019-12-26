<?php

namespace Helldar\ShortUrl\Exceptions;

use Exception;
use Helldar\ShortUrl\Variables\Model;

use function implode;
use function sprintf;

class IncorrectModelKeyIdentifierException extends Exception
{
    public function __construct(string $value)
    {
        $available = implode(', ', Model::available());
        $message   = sprintf('Incorrect model key identifier: %s, but available (%s)', $value, $available);

        parent::__construct($message, 400);
    }
}
