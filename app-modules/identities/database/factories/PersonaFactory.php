<?php

namespace FossHaas\Identities\Database\Factories;

use Arr;
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
            'profile' => [
                'company' => fake()->company(),
                'department' => fake()->words(3, true),
                'job_title' => fake()->jobTitle(),
            ],
        ];
    }

    public function fromAccountIdentity(AccountIdentity $accountIdentity): static
    {
        return $this->state(fn (array $attributes) => [
            'account_id' => $accountIdentity->account_id,
            'first_name' => array_key_exists('first_name', $accountIdentity->profile_data) ? $accountIdentity->profile_data['first_name'] : $attributes['first_name'],
            'last_name' => array_key_exists('last_name', $accountIdentity->profile_data) ? $accountIdentity->profile_data['last_name'] : $attributes['last_name'],
            'profile' => [...$attributes['profile'], ...Arr::except($accountIdentity->profile_data, [
                'first_name',
                'last_name',
                'email',
                'is_disabled',
                'created_at',
                'updated_at',
            ])],
        ]);
    }
}
