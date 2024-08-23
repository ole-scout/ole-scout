<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('branding.name', config('app.name'));
        $this->migrator->add('branding.brandColor', '#1c1e29');
        $this->migrator->add('branding.primaryColor', '#6366f1');
        $this->migrator->add('branding.logo', null);
    }
};
