<?php

use Helldar\ShortUrl\Variables\Model;

return [
    /*
     * The source of the unique identifier.
     *
     * Available:
     *   1 - Helldar\ShortUrl\Variables\Model::PRIMARY_KEY
     *   2 - Helldar\ShortUrl\Variables\Model::UNIQUE_STRING
     *
     * Default, 2.
     */

    'key' => Model::UNIQUE_STRING,

    /*
     * Route name.
     *
     * Default, 'short_url'.
     */

    'route_name' => 'short_url',

    /*
     * URL prefix for the route.
     *
     * Default, 'go'.
     */

    'url_prefix' => 'go',

    /*
     * Redirect status code.
     *
     * Default, 301.
     */

    'redirect_code' => 301,
];
