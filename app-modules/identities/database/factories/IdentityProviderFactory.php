<?php

namespace FossHaas\Identities\Database\Factories;

use Arr;
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
            'name' => ['en' => fake()->words(3, true)],
            'config' => [],
            'is_enabled' => true,
            'created_at' => now(),
        ];
    }

    public function ldap(): self
    {
        return $this->state(function (array $attributes) {
            $use_ssl = fake()->boolean();
            $domain = fake()->domainName().'.internal';

            return [
                'type' => IdentityProviderType::LDAP,
                'config' => [
                    'host' => fake()->domainName().'.internal',
                    'use_ssl' => $use_ssl,
                    'port' => $use_ssl ? 636 : 389,
                    'domain' => $domain,
                    'username' => fake()->userName(),
                    'password' => fake()->password(),
                    'searchRealm' => implode(',', Arr::map(
                        array_reverse(explode('.', $domain)),
                        fn ($part) => 'DC='.$part
                    )),
                ],
            ];
        });
    }

    public function oidc(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => IdentityProviderType::OIDC,
                'config' => [
                    'issuer_url' => fake()->url(),
                    'client_id' => fake()->uuid(),
                    'client_secret' => fake()->uuid(),
                ],
            ];
        });
    }
}
