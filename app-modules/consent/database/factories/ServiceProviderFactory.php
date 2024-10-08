<?php

namespace FossHaas\Consent\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Consent\Models\ServiceProvider>
 */
class ServiceProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locales = array_keys(config('support.locales'));
        $phoneUtil = PhoneNumberUtil::getInstance();
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'email' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $locale . '.' . $this->faker->email()
            ]),
            'phone' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $phoneUtil->format(
                    $phoneUtil->parse($this->faker->phoneNumber(), 'US'),
                    PhoneNumberFormat::INTERNATIONAL
                )
            ]),
            'privacy_policy' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $this->faker->url() . '?lang=' . $locale
            ]),
            'imprint' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $this->faker->url() . '?lang=' . $locale
            ]),
            'contact' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $this->faker->url() . '?lang=' . $locale
            ]),
        ];
    }
}
