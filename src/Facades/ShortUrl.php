<?php

namespace Helldar\ShortUrl\Facades;

use Helldar\ShortUrl\Services\ShortService;
use Illuminate\Support\Facades\Facade;

/**
 * Helldar\ShortUrl\Facades\ShortUrl
 *
 * @@method static \Helldar\ShortUrl\Models\Short get($key)
 * @@method static \Helldar\ShortUrl\Models\Short set($url)
 * @@method static \Helldar\ShortUrl\Models\Short search($key)
 */
class ShortUrl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ShortService::class;
    }
}
