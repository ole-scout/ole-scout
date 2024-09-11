<?php

namespace FossHaas\Consent\Database\Factories;

use FossHaas\Consent\Enums\Category;
use FossHaas\Consent\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Consent\Models\ServiceDefinition>
 */
class ServiceDefinitionFactory extends Factory
{

    public function essential(): self
    {
        return $this->state([
            'category' => Category::ESSENTIAL,
        ]);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locales = array_keys(config('support.locales'));
        return [
            'category' => $this->faker->randomElement(
                Arr::where(
                    Category::cases(),
                    fn(Category $case) => $case !== Category::ESSENTIAL
                )
            ),
            'name' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $locale . ': ' . ucwords(
                    $this->faker->words($this->faker->numberBetween(2, 3), true)
                )
            ]),
            'description' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $locale . ': ' . $this->faker->paragraph()
            ]),
            'service_provider_id' => ServiceProvider::factory(),
        ];
    }
}
