<?php

namespace Helldar\ShortUrl\Facades;

use Helldar\ShortUrl\Models\Short;
use Helldar\ShortUrl\Services\ShortService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Short get($key)
 * @method static Short set($url)
 * @method static Short search($key)
 */
class ShortUrl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ShortService::class;
    }
}
