<?php

namespace Helldar\ShortUrl\Facades;

use Helldar\ShortUrl\Services\ShortService;
use Illuminate\Support\Facades\Facade;

class ShortUrl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ShortService::class;
    }
}
