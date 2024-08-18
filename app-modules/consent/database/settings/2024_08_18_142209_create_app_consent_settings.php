<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('consent::app.service_ids', []);
        $this->migrator->add('consent::app.privacy_url', '/privacy');
        $this->migrator->add('consent::app.consent_url', '/consent');
        $this->migrator->add('consent::app.imprint_url', null);
    }
};
