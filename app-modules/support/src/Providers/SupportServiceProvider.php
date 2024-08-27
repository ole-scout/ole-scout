<?php

namespace FossHaas\Support\Providers;

use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    protected string $base_dir;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->base_dir = str_replace('\\', '/', dirname(__DIR__, 2));
    }

    public function register(): void
    {
        $this->mergeConfigFrom("{$this->base_dir}/config.php", 'support');
    }

    public function boot(): void {}
}
