<?php

namespace FossHaas\Consent\Database\Factories;

use FossHaas\Consent\CookieType;
use FossHaas\Consent\LegalBasis;
use FossHaas\Consent\Models\ServiceDefinition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Consent\Models\ServiceCookie>
 */
class ServiceCookieFactory extends Factory
{

    public function essential(): self
    {
        return $this->state([
            'legalBasis' => fn () => $this->faker->randomElement(
                Arr::where(
                    LegalBasis::cases(),
                    fn (LegalBasis $case) => $case !== LegalBasis::consent
                )
            ),
        ]);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $durations = [
            ['minutes', 1], ['minutes', 30],
            ['hours', 1], ['hours', 6], ['hours', 24], ['hours', 48],
            ['days', 5], ['days', 14], ['days', 28], ['days', 30],
            ['days', 90], ['days', 180], ['days', 365],
            ['months', 1], ['months', 2], ['months', 3], ['months', 6],
            ['years', 1], ['years', 2], ['years', 3],
        ];
        return [
            'type' => $this->faker->randomElement(CookieType::cases()),
            'name' => $this->faker->word,
            'duration' => fn (array $attributes) => match ($attributes['type']) {
                CookieType::session_storage => 'session',
                CookieType::local_storage => 'indefinite',
                default => $this->faker->randomElement($durations),
            },
            'legalBasis' => LegalBasis::consent,
            'service_definition_id' => ServiceDefinition::factory(),
        ];
    }
}
