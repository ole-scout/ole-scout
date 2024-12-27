<?php

namespace FossHaas\Identities\Database\Factories;

use FossHaas\Identities\Models\AccountIdentity;
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
            'org' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => fake()->unixTime(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function fromAccountIdentity(AccountIdentity $accountIdentity): static
    {
        return $this->state(fn (array $attributes) => [
            'account_id' => $accountIdentity->account_id,
            'first_name' => array_key_exists('first_name', $accountIdentity->profile_data) ? $accountIdentity->profile_data['first_name'] : $attributes['first_name'],
            'last_name' => array_key_exists('last_name', $accountIdentity->profile_data) ? $accountIdentity->profile_data['last_name'] : $attributes['last_name'],
            'email' => array_key_exists('email', $accountIdentity->profile_data) ? $accountIdentity->profile_data['email'] : $attributes['email'],
        ]);
    }
}
