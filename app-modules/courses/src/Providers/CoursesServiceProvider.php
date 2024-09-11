<?php

namespace FossHaas\Courses\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class CoursesServiceProvider extends ServiceProvider
{
	public function register(): void {}

	public function boot(): void
	{
		Relation::enforceMorphMap([
			'download' => 'FossHaas\Courses\Models\DownloadActivity',
			'weblink' => 'FossHaas\Courses\Models\WeblinkActivity',
		]);
	}
}
