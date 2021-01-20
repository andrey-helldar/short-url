<?php

namespace Helldar\ShortUrl\Exceptions;

use Helldar\ShortUrl\Variables\Model;
use Symfony\Component\HttpKernel\Exception\HttpException;

class IncorrectModelKeyException extends HttpException
{
    public function __construct(string $value)
    {
        parent::__construct(400, $this->message($value));
    }

    protected function message(string $value): string
    {
        return sprintf('Incorrect model key identifier: %s, but available (%s)', $value, $this->available());
    }

    protected function available(): string
    {
        return implode(', ', $this->getConstants());
    }

    protected function getConstants(): array
    {
        return Model::available();
    }
}
