<?php

namespace FossHaas\Consent\Database\Factories;

use FossHaas\Consent\Category;
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
            'category' => Category::essential,
        ]);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => fn () => $this->faker->randomElement(
                Arr::where(
                    Category::cases(),
                    fn (Category $case) => $case !== Category::essential
                )
            ),
            'service_provider_id' => ServiceProvider::factory(),
        ];
    }
}
