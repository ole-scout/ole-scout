<?php

namespace FossHaas\Consent\Settings;

use FossHaas\Consent\Settings\AppConsentSettings;
use FossHaas\Consent\Models\ServiceProvider;
use Spatie\LaravelSettings\Settings;

class ServiceProviderSettings extends Settings
{
    public ?string $name;
    public ?string $address;
    public ?string $email;
    public ?string $phone;

    public static function group(): string
    {
        return 'consent::service_provider';
    }

    public function asServiceProvider()
    {
        $settings = app(AppConsentSettings::class);
        return new ServiceProvider([
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'privacy_policy' => $settings->privacyPolicy(),
            'imprint' => $settings->imprint(),
        ]);
    }
}
