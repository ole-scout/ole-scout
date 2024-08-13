<?php

namespace FossHaas\Consent\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Consent\Models\ServiceProviderLocale>
 */
class ServiceProviderLocaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $locales = array_keys(config('support.locales'));
        return [
            'locale' => new Sequence($locales),
            'email' => fn ($attributes) => $attributes['locale'] . '.' . $this->faker->email,
            'phone' => fn () => $phoneUtil->format(
                $phoneUtil->parse($this->faker->phoneNumber(), 'US'),
                PhoneNumberFormat::INTERNATIONAL
            ),
            'privacy_policy' => fn ($attributes) => $this->faker->url . '?lang=' . $attributes['locale'],
            'imprint' => fn ($attributes) => $this->faker->url . '?lang=' . $attributes['locale'],
            'contact' => fn ($attributes) => $this->faker->url . '?lang=' . $attributes['locale'],
        ];
    }
}
