<?php

namespace Helldar\ShortUrl\Services;

use Helldar\ShortUrl\Exceptions\IncorrectUrlException;
use Helldar\ShortUrl\Models\Short as ShortModel;
use Helldar\ShortUrl\Variables\Model;
use Helldar\Support\Facades\Digit;
use Helldar\Support\Laravel\Models\ModelHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ShortService
{
    /** @var int */
    private $key;

    /**
     * @throws \Helldar\ShortUrl\Exceptions\IncorrectModelKeyIdentifierException
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
     * @param string $url
     *
     * @throws \Helldar\ShortUrl\Exceptions\IncorrectUrlException
     * @return string
     */
    public function set(string $url): string
    {
        $this->validateUrl($url);

        $item = ShortModel::firstOrCreate(compact('url'));

        $this->setKey($item);

        return $this->route($item->key);
    }

    public function search(string $key): ShortModel
    {
        /** @var \Helldar\ShortUrl\Models\Short $item */
        $item = ShortModel::where('key', $key)->firstOrFail();

        $item->increment('visited');

        return $item;
    }

    private function route(string $key): string
    {
        $name = config('short_url.route_name', 'go');

        return route($name, $key);
    }

    /**
     * @param string $url
     *
     * @throws \Helldar\ShortUrl\Exceptions\IncorrectUrlException
     */
    private function validateUrl(string $url)
    {
        $validator = Validator::make(compact('url'), [
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            throw new IncorrectUrlException($validator->errors()->first());
        }
    }

    /**
     * @param \Helldar\ShortUrl\Models\Short $model
     *
     * @throws \Helldar\Support\Exceptions\Laravel\IncorrectModelException
     *
     * @return \Helldar\ShortUrl\Models\Short
     */
    private function setKey(ShortModel $model): ShortModel
    {
        if (! $model->key) {
            $helper = new ModelHelper;

            switch ($this->key) {
                case Model::PRIMARY_KEY:
                    $primary = $helper->primaryKey($model);
                    $id      = $model->{$primary};

                    $key = Digit::shortString($id);
                    break;

                default:
                    $key = Str::slug(uniqid(null, true));
                    break;
            }

            $model->update(compact('key'));
        }

        return $model;
    }
}
