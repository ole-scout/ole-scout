<?php

namespace FossHaas\Consent\Database\Seeders;

use FossHaas\Consent\Models\ServiceCookie;
use FossHaas\Consent\Models\ServiceCookieLocale;
use FossHaas\Consent\Models\ServiceDefinition;
use FossHaas\Consent\Models\ServiceDefinitionLocale;
use FossHaas\Consent\Models\ServiceProvider;
use FossHaas\Consent\Models\ServiceProviderLocale;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class FakeServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = array_keys(config('support.locales'));
        $eachLocale = Arr::map($locales, fn (string $locale) => ['locale' => $locale]);
        $operator = ServiceProvider::factory()
            ->has(
                ServiceProviderLocale::factory()
                    ->forEachSequence(...$eachLocale)
            )
            ->create();

        ServiceCookie::factory(fake()->numberBetween(3, 7))
            ->has(
                ServiceCookieLocale::factory()
                    ->forEachSequence(...$eachLocale)
            )
            ->recycle(
                ServiceDefinition::factory()
                    ->has(
                        ServiceDefinitionLocale::factory()
                            ->forEachSequence(...$eachLocale)
                    )
                    ->recycle($operator)
                    ->essential()
                    ->create()
            )
            ->essential()
            ->create();

        $providers = ServiceProvider::factory(fake()->numberBetween(3, 5))
            ->has(
                ServiceProviderLocale::factory()
                    ->forEachSequence(...$eachLocale)
            )
            ->create()
            ->merge([$operator]);

        $services = ServiceDefinition::factory(fake()->numberBetween(3, 15))
            ->has(
                ServiceDefinitionLocale::factory()
                    ->forEachSequence(...$eachLocale)
            )
            ->recycle($providers)
            ->create();

        ServiceCookie::factory(fake()->numberBetween(15, 75))
            ->has(
                ServiceCookieLocale::factory()
                    ->forEachSequence(...$eachLocale)
            )
            ->recycle($services)
            ->create();
    }
}
