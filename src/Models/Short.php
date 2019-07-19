<?php

namespace Helldar\ShortUrl\Models;

use Helldar\ShortUrl\Exceptions\IncorrectUrlException;
use Helldar\Support\Facades\Digit;
use Illuminate\Database\Eloquent\Model;

class Short extends Model
{
    protected $fillable = ['key', 'host', 'url', 'visited'];

    protected function setKeyAttribute()
    {
        $this->attributes['key'] = Digit::shortString($this->primaryKey);
    }

    /**
     * @throws \Helldar\ShortUrl\Exceptions\IncorrectUrlException
     */
    protected function setUrlAttribute($url)
    {
        if (\filter_var($this->getAttribute('url'), FILTER_VALIDATE_URL) === false) {
            throw new IncorrectUrlException($url);
        }

        $this->attributes['url'] = $url;

        $this->setAttribute('host', \parse_url($url, PHP_URL_HOST));
        $this->setAttribute('key', $this->getAttribute($this->primaryKey));
    }
}
