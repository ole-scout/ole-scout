<?php

namespace FossHaas\Identities\Database\Factories;

use FossHaas\Identities\Enums\IdentityProviderType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Identities\Models\IdentityProvider>
 */
class IdentityProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->slug(),
            'type' => IdentityProviderType::LOCAL,
            'name' => ['en' => fake()->words(3, true)],
            'config' => [],
            'is_enabled' => true,
            'created_at' => now(),
        ];
    }
}
