<?php

namespace FossHaas\Consent\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Consent\Models\ServiceDefinitionLocale>
 */
class ServiceDefinitionLocaleFactory extends Factory
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
            'name' => fn ($attributes) => $attributes['locale'] . ': ' . ucwords(
                $this->faker->words($this->faker->numberBetween(1, 3), true)
            ),
            'description' => fn ($attributes) => $attributes['locale'] . ': ' . $this->faker->paragraph,
        ];
    }
}
