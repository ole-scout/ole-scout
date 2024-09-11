<?php

namespace FossHaas\Courses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\CourseGroup>
 */
class CourseGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locales = array_keys(config('support.locales'));
        return [
            'parent_id' => null,
            'order_column' => $this->faker->numberBetween(0, 100),
            'slug' => $this->faker->slug(),
            'title' => fn() => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $locale . ': ' . $this->faker->words(
                    $this->faker->numberBetween(2, 3),
                    true
                )
            ]),
            'color' => $this->faker->hexColor(),
            'icon' => fn($attributes) => 'https://place-hold.it/128/128/' . ltrim($attributes['color'], '#'),
        ];
    }
}
