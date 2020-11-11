<?php

namespace Helldar\ShortUrl\Http\Controllers;

use Helldar\ShortUrl\Facades\ShortUrl;
use Illuminate\Routing\Controller as BaseController;

class ShortUrlController extends BaseController
{
    /**
     * @param  string  $key
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function go(string $key)
    {
        $item = ShortUrl::search($key);
        $code = config('short_url.redirect_code');

        return redirect()->away($item->url, $code);
    }
}
