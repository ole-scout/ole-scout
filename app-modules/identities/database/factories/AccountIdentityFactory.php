<?php

namespace FossHaas\Identities\Database\Factories;

use FossHaas\Identities\Models\IdentityProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Identities\Models\AccountIdentity>
 */
class AccountIdentityFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identifier' => fake()->userName(),
            'credentials' => [],
            'profile_data' => [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'org' => fake()->company(),
                'email' => fake()->unique()->safeEmail(),
                'is_disabled' => false,
                'created_at' => fake()->unixTime(),
                'updated_at' => now(),
            ],
        ];
    }

    public function forIdentityProvider(IdentityProvider $identityProvider): static
    {
        return $this->state(fn (array $attributes) => [
            'identity_provider_id' => $identityProvider->id,
            'credentials' => [],
        ]);
    }
}
