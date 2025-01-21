<?php

namespace FossHaas\Identities\Providers;

use FossHaas\Identities\Hashing\DelegatingHasher;
use Illuminate\Support\ServiceProvider;

class IdentitiesServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        app('hash')->extend('delegating', function ($app) {
            $options = $app['config']->get('hashing.delegating') ?? [];

            return new DelegatingHasher($options);
        });
    }
}
