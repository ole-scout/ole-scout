<?php

namespace FossHaas\Util\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class UtilServiceProvider extends ServiceProvider
{
	public function register(): void
	{
	}

	public function boot(): void
	{
		Blade::directive('markdown', function ($expression) {
			return "<?php echo FossHaas\Util\Markdown::markdown($expression); ?>";
		});
	}
}
