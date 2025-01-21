<?php

namespace FossHaas\Identities\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Identities\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'profile' => [
                'company' => fake()->company(),
                'department' => fake()->words(3, true),
                'job_title' => fake()->jobTitle(),
            ],
        ];
    }
}
