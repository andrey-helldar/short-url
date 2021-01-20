<?php

namespace Tests\Concerns;

/** @mixin \Tests\TestCase */
trait Database
{
    protected $database = 'testing';

    protected function setDatabase($app): void
    {
        $app['config']->set('database.default', $this->database);

        $app['config']->set('database.connections.' . $this->database, [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
