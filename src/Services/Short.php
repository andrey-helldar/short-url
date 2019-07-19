<?php

namespace Helldar\ShortUrl\Services;

use Helldar\ShortUrl\Models\Short as ShortModel;

class Short
{
    public static function get(string $key): ShortModel
    {
        $item = ShortModel::where('key', $key)->firstOrFail();

        $item->increment('visited');

        return $item;
    }

    public static function set(string $url): ShortModel
    {
        return ShortModel::create(\compact('url'));
    }
}
