<?php

namespace FossHaas\Consent\Database\Seeders;

use FossHaas\Consent\Models\ServiceCookie;
use FossHaas\Consent\Models\ServiceDefinition;
use FossHaas\Consent\Models\ServiceProvider;
use Illuminate\Database\Seeder;

class FakeServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $operator = ServiceProvider::factory()
            ->create();

        ServiceCookie::factory(fake()->numberBetween(3, 7))
            ->recycle(
                ServiceDefinition::factory()
                    ->recycle($operator)
                    ->essential()
                    ->create()
            )
            ->essential()
            ->create();

        $providers = ServiceProvider::factory(fake()->numberBetween(3, 5))
            ->create()
            ->merge([$operator]);

        $services = ServiceDefinition::factory(fake()->numberBetween(3, 15))
            ->recycle($providers)
            ->create();

        ServiceCookie::factory(fake()->numberBetween(15, 75))
            ->recycle($services)
            ->create();
    }
}
