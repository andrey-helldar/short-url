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
     * By default, 1.
     */

    'key' => Model::PRIMARY_KEY,
];
