<?php

namespace Helldar\ShortUrl\Variables;

use Helldar\ShortUrl\Exceptions\IncorrectModelKeyException;
use ReflectionClass;

class Model
{
    public const PRIMARY_KEY = 1;

    public const UNIQUE_STRING = 2;

    /**
     * @param  int  $value
     *
     * @throws \Helldar\ShortUrl\Exceptions\IncorrectModelKeyException
     */
    public static function verify(int $value): void
    {
        if (self::unavailable($value)) {
            throw new IncorrectModelKeyException($value);
        }
    }

    public static function available(): array
    {
        $class = new ReflectionClass(self::class);

        return array_values($class->getConstants());
    }

    protected static function unavailable(int $value): bool
    {
        return ! is_int($value) || ! in_array($value, self::available());
    }
}
