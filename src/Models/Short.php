<?php

namespace Helldar\ShortUrl\Models;

use Helldar\Support\Facades\Helpers\Http;
use Helldar\Support\Facades\Helpers\HttpBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string|null $key
 * @property string $host
 * @property string $url
 * @property int $visited
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static Builder|Short newModelQuery()
 * @method static Builder|Short newQuery()
 * @method static Builder|Short query()
 * @method static Builder|Short whereId($value)
 * @method static Builder|Short whereKey($value)
 * @method static Builder|Short whereHost($value)
 * @method static Builder|Short whereUrl($value)
 * @method static Builder|Short whereVisited($value)
 * @method static Builder|Short whereCreatedAt($value)
 * @method static Builder|Short whereUpdatedAt($value)
 */
class Short extends Model
{
    protected $fillable = ['key', 'host', 'url', 'visited'];

    public function __construct(array $attributes = [])
    {
        $this->connection = config('short_url.connection');
        $this->table      = config('short_url.table', 'shorts');

        parent::__construct($attributes);
    }

    protected function setUrlAttribute(string $url)
    {
        Http::validateUrl($url);

        $builder = HttpBuilder::parse($url);

        $this->attributes['url']  = $builder->compile();
        $this->attributes['host'] = $builder->getHost();
    }
}
