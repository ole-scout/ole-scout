<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SystemSettings extends Settings
{
    public string $core_service_id;
    public string $youtube_service_id;
    public string $vimeo_service_id;

    public static function group(): string
    {
        return 'system';
    }
}
