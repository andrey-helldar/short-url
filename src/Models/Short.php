<?php

namespace Helldar\ShortUrl\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * \Helldar\ShortUrl\Models\Short
 *
 * @property int id
 * @property null|string $key
 * @property string $host
 * @property string $url
 * @property int $visited
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short whereVisited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Helldar\ShortUrl\Models\Short whereUpdatedAt($value)
 */
class Short extends Model
{
    protected $fillable = ['key', 'host', 'url', 'visited'];

    public function __construct(array $attributes = [])
    {
        $this->connection = \config('short_url.connection');
        $this->table      = \config('short_url.table', 'shorts');

        parent::__construct($attributes);
    }

    protected function setUrlAttribute(string $url)
    {
        $this->attributes['url'] = $url;

        $this->setAttribute('host', \parse_url($url, PHP_URL_HOST));
    }
}
