<?php

namespace FossHaas\Identities\Database\Factories;

use FossHaas\Identities\Enums\IdentityProviderType;
use FossHaas\Identities\Models\IdentityProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Identities\Models\AccountIdentity>
 */
class AccountIdentityFactory extends Factory
{
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
            'profile_data' => [],
        ];
    }

    public function forIdentityProvider(IdentityProvider $identityProvider): static
    {
        return $this->state(fn (array $attributes) => [
            'identity_provider_id' => $identityProvider->id,
            'credentials' => match ($identityProvider->type) {
                IdentityProviderType::OIDC => [
                    'access_token' => Str::random(32),
                    'refresh_token' => Str::random(32),
                    'id_token' => Str::random(32),
                ],
                IdentityProviderType::LDAP => [
                    'userPrincipalName' => fake()->userName().'@'.fake()->domainName(),
                    'objectGUID' => fake()->uuid(),
                ],
            },
            'profile_data' => match ($identityProvider->type) {
                IdentityProviderType::OIDC => [
                    'first_name' => fake()->firstName(), // givenName
                    'last_name' => fake()->lastName(), // surname
                    'company' => fake()->company(), // companyName
                    'department' => fake()->words(3, true),
                    'job_title' => fake()->jobTitle(), // jobTitle
                    'email' => fake()->unique()->safeEmail(), // mail
                    'is_disabled' => false, // accountEnabled
                    'created_at' => fake()->unixTime(), // createdDateTime (ISO)
                ],
                IdentityProviderType::LDAP => [
                    'first_name' => fake()->firstName(), // givenName
                    'last_name' => fake()->lastName(), // sn
                    'company' => fake()->company(),
                    'department' => fake()->words(3, true),
                    'job_title' => fake()->jobTitle(), // title
                    'email' => fake()->unique()->safeEmail(), // mail
                    'is_disabled' => false, // userAccountControl (bit flag)
                    'created_at' => fake()->unixTime(), // whenCreated (modified ISO)
                    'updated_at' => now()->unix(), // whenChanged (modified ISO)
                ],
            },
        ]);
    }
}
