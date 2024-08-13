<?php

namespace FossHaas\Consent\Database\Seeders;

use FossHaas\Consent\Models\ServiceCookie;
use FossHaas\Consent\Models\ServiceDefinition;
use FossHaas\Consent\Models\ServiceProvider;
use FossHaas\Consent\Settings\ServiceProviderSettings;
use FossHaas\Support\PhoneNumber;
use Illuminate\Database\Seeder;

class FakeServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(ServiceProviderSettings $settings): void
    {
        $appService = ServiceDefinition::factory()
            ->state((['service_provider_id' => null]))
            ->essential()
            ->create();
        ServiceCookie::factory(fake()->numberBetween(3, 7))
            ->recycle($appService)
            ->essential()
            ->create();

        $settings->name = fake()->company();
        $settings->address = fake()->address();
        $settings->email = fake()->email();
        $settings->phone = PhoneNumber::format(fake()->phoneNumber(), 'US');
        $settings->save();

        $providers = ServiceProvider::factory(fake()->numberBetween(3, 5))
            ->create();
        foreach ([null, ...$providers] as $provider) {
            $services = ServiceDefinition::factory(
                $provider === null ? 1 : fake()->numberBetween(1, 3)
            )
                ->state(['service_provider_id' => $provider])
                ->create();
            foreach ($services as $service) {
                ServiceCookie::factory(fake()->numberBetween(2, 7))
                    ->recycle($service)
                    ->create();
            }
        }
    }
}
