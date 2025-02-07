<?php

namespace FossHaas\Lrs\Providers;

use FossHaas\Lrs\DataValidationRulesResolver;
use Illuminate\Support\ServiceProvider;

class LrsServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        app()->singleton(\Spatie\LaravelData\Resolvers\DataValidationRulesResolver::class, DataValidationRulesResolver::class);
    }
}
