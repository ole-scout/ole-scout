<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateServiceProviderSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('consent::service_provider.name', null);
        $this->migrator->add('consent::service_provider.address', null);
        $this->migrator->add('consent::service_provider.email', null);
        $this->migrator->add('consent::service_provider.phone', null);
    }
};
