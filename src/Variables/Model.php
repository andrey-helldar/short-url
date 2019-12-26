<?php

namespace Helldar\ShortUrl\Variables;

use Helldar\ShortUrl\Exceptions\IncorrectModelKeyIdentifierException;

use ReflectionClass;

use function array_values;
use function in_array;
use function is_int;

class Model
{
    const PRIMARY_KEY = 1;

    const UNIQUE_STRING = 2;

    /**
     * @param int $value
     *
     * @throws \Helldar\ShortUrl\Exceptions\IncorrectModelKeyIdentifierException
     */
    public static function verify(int $value)
    {
        if (! is_int($value) || ! in_array($value, self::available())) {
            throw new IncorrectModelKeyIdentifierException($value);
        }
    }

    public static function available(): array
    {
        $class = new ReflectionClass(__CLASS__);

        return array_values($class->getConstants());
    }
}
