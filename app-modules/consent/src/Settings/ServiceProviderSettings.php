<?php

namespace FossHaas\Consent\Settings;

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
        return new ServiceProvider([
            'name' => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone,
            'privacy_policy' => url('/privacy'),
            'imprint' => url('/imprint'),
        ]);
    }
}
