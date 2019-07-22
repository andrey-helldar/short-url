<?php

namespace Helldar\ShortUrl;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/settings.php' => \config_path('short_url.php'),
        ]);

        $this->loadMigrationsFrom(
            __DIR__ . '/resources/migrations'
        );
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/settings.php', 'short_url'
        );
    }
}
