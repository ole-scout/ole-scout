<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('system.core_service_id', '');
        $this->migrator->add('system.youtube_service_id', '');
        $this->migrator->add('system.vimeo_service_id', '');
    }
};
