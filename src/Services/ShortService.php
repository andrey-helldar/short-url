<?php

namespace Helldar\ShortUrl\Services;

use Helldar\LaravelSupport\Traits\InitModelHelper;
use Helldar\ShortUrl\Models\Short as ShortModel;
use Helldar\ShortUrl\Variables\Model;
use Helldar\Support\Facades\Helpers\Digit;
use Helldar\Support\Facades\Helpers\Http;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ShortService
{
    use InitModelHelper;

    /** @var int */
    protected $key;

    /**
     * @throws \Helldar\ShortUrl\Exceptions\IncorrectModelKeyException
     */
    public function __construct()
    {
        $this->key = config('short_url.key', 2);

        Model::verify($this->key);
    }

    public function get(string $key): string
    {
        $item = $this->search($key);

        return $this->route($item->key);
    }

    /**
     * @param  string  $url
     *
     * @throws \Helldar\LaravelSupport\Exceptions\IncorrectModelException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return string
     */
    public function set(string $url): string
    {
        $this->validateUrl($url);

        /** @var \Helldar\ShortUrl\Models\Short $item */
        $item = $this->builder()->firstOrCreate(compact('url'));

        $this->setKey($item);

        return $this->route($item->key);
    }

    public function search(string $key): ShortModel
    {
        /** @var \Helldar\ShortUrl\Models\Short|\Illuminate\Database\Eloquent\Builder $item */
        $item = $this->builder()->where('key', $key)->firstOrFail();

        $item->increment('visited');

        return $item;
    }

    protected function route(string $key): string
    {
        $name = config('short_url.route_name', 'short_url');

        return route($name, compact('key'));
    }

    protected function validateUrl(string $url)
    {
        Http::validateUrl($url);
    }

    /**
     * @param  \Helldar\ShortUrl\Models\Short  $model
     *
     * @throws \Helldar\LaravelSupport\Exceptions\IncorrectModelException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return \Helldar\ShortUrl\Models\Short
     */
    protected function setKey(ShortModel $model): ShortModel
    {
        if (empty($model->key)) {
            $key = $this->getModelKey($model);

            $model->update(compact('key'));
        }

        return $model;
    }

    /**
     * @param  \Helldar\ShortUrl\Models\Short  $model
     *
     * @throws \Helldar\LaravelSupport\Exceptions\IncorrectModelException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return string
     */
    protected function getModelKey(ShortModel $model): string
    {
        return $this->key === Model::PRIMARY_KEY ? $this->getPrimaryKey($model) : $this->getUniqueKey();
    }

    /**
     * @param  \Helldar\ShortUrl\Models\Short  $model
     *
     * @throws \Helldar\LaravelSupport\Exceptions\IncorrectModelException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return string
     */
    protected function getPrimaryKey(ShortModel $model): string
    {
        $primary = $this->model()->primaryKey($model);

        $id = $model->{$primary};

        return Digit::shortKey($id);
    }

    protected function getUniqueKey(): string
    {
        return Str::slug(uniqid('', true));
    }

    protected function builder(): Builder
    {
        return ShortModel::query();
    }
}
