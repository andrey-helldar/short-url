<?php

$route_name = \config('short_url.route_name', 'short_url');
$url_prefix = \config('short_url.url_prefix', 'go');

\app('router')
    ->get("{$url_prefix}/{key}", 'Helldar\ShortUrl\Http\Controllers\ShortUrlController@go')
    ->name($route_name);
