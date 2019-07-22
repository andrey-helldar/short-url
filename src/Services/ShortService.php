<?php

namespace Helldar\ShortUrl\Services;

use Helldar\ShortUrl\Models\Short as ShortModel;
use Helldar\ShortUrl\Variables\Model;
use Helldar\Support\Facades\Digit;
use Illuminate\Support\Str;

class ShortService
{
    /** @var int */
    private $key;

    /**
     * Short constructor.
     *
     * @throws \Helldar\ShortUrl\Exceptions\IncorrectModelKeyIdentifierException
     */
    public function __construct()
    {
        $this->key = \config('short_url.key', 1);

        Model::verify($this->key);
    }

    public function get(string $key): ShortModel
    {
        $item = ShortModel::where('key', $key)->firstOrFail();

        $item->increment('visited');

        return $item;
    }

    public function set(string $url): ShortModel
    {
        $item = ShortModel::firstOrCreate(\compact('url'));

        if (\is_null($item->key)) {
            switch ($this->key) {
                case Model::UNIQUE_STRING:
                    $key = Str::slug(\uniqid(null, true));
                    break;

                default:
                    $key = Digit::shortString($item->key);
                    break;
            }

            $item->update(\compact('key'));
        }

        return $item;
    }
}
