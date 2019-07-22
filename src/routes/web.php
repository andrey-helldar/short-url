<?php

$prefix = \config('short_url.url_prefix', 'go');

\app('router')
    ->get("{$prefix}/{key}", 'Helldar\ShortUrl\Http\Controllers\ShortUrlController@go')
    ->name('short_url');
