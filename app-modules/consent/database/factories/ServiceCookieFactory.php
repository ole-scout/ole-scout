<?php

namespace FossHaas\Consent\Database\Factories;

use FossHaas\Consent\Enums\CookieType;
use FossHaas\Consent\Enums\LegalBasis;
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
            'legal_basis' => fn() => $this->faker->randomElement(
                Arr::where(
                    LegalBasis::cases(),
                    fn(LegalBasis $case) => $case !== LegalBasis::CONSENT
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
        $locales = array_keys(config('support.locales'));
        $durations = [
            ['minutes', 1],
            ['minutes', 30],
            ['hours', 1],
            ['hours', 6],
            ['hours', 24],
            ['hours', 48],
            ['days', 5],
            ['days', 14],
            ['days', 28],
            ['days', 30],
            ['days', 90],
            ['days', 180],
            ['days', 365],
            ['months', 1],
            ['months', 2],
            ['months', 3],
            ['months', 6],
            ['years', 1],
            ['years', 2],
            ['years', 3],
        ];
        return [
            'type' => $this->faker->randomElement(CookieType::cases()),
            'name' => $this->faker->word,
            'host' => $this->faker->domainName,
            'description' => fn() => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $locale . ': ' . $this->faker->paragraph()
            ]),
            'duration' => fn(array $attributes) => match ($attributes['type']) {
                CookieType::SESSION_STORAGE => 'session',
                CookieType::LOCAL_STORAGE => 'indefinite',
                default => $this->faker->randomElement($durations),
            },
            'legal_basis' => LegalBasis::CONSENT,
            'service_definition_id' => ServiceDefinition::factory(),
        ];
    }
}
