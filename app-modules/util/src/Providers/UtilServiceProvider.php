<?php

namespace FossHaas\Util\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class UtilServiceProvider extends ServiceProvider
{
    protected string $base_dir;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->base_dir = str_replace('\\', '/', dirname(__DIR__, 2));
    }

    public function register(): void
    {
        $this->mergeConfigFrom("{$this->base_dir}/config.php", 'util');
    }

    public function boot(): void
    {
        Blade::directive('markdown', function ($expression) {
            return "<?php echo FossHaas\Util\Markdown::markdown($expression); ?>";
        });
    }
}
