<?php

namespace FossHaas\Consent\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Consent\Models\ServiceCookieLocale>
 */
class ServiceCookieLocaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locales = array_keys(config('support.locales'));
        return [
            'locale' => new Sequence($locales),
            'content' => fn ($attributes) => $attributes['locale'] . ': ' . $this->faker->paragraph,
            'purpose' => fn ($attributes) => $attributes['locale'] . ': ' . $this->faker->paragraph,
        ];
    }
}
