<?php

namespace App\Providers;

use App\Hashing\FoxxAuthHasher;
use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Facades\Translatable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $manager = app('hash');
        $manager->extend('foxx-auth', function ($app) {
            return new FoxxAuthHasher(
                $app->make('config')->get('hashing.foxx-auth') ?? []
            );
        });
        $manager->driver('delegating')
            ->setRules([
                'argon2id' => '/^\$argon2id\$/',
                'foxx-auth' => '/^\{.+\}$/',
            ]);
        Translatable::fallback(
            fallbackAny: true,
        );
    }
}
