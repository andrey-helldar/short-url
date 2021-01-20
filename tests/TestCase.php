<?php

namespace Tests;

use Helldar\ShortUrl\ServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Tests\Concerns\AssertDatabase;
use Tests\Concerns\Database;

abstract class TestCase extends BaseTestCase
{
    use AssertDatabase;
    use Database;
    use RefreshDatabase;

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $this->setDatabase($app);
    }

    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }
}
