<?php

namespace Helldar\ShortUrl\Http\Controllers;

use Helldar\ShortUrl\Facades\ShortUrl;

class ShortUrlController extends Controller
{
    /**
     * @param string $key
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function go(string $key)
    {
        $item = ShortUrl::search($key);
        $code = \config('short_url.redirect_code', 301);

        return \redirect()->away($item->url, $code);
    }
}
