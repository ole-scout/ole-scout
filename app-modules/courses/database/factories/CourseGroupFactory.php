<?php

namespace FossHaas\Courses\Database\Factories;

use FossHaas\Courses\Models\CourseGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\CourseGroup>
 */
class CourseGroupFactory extends Factory
{
    public function withParent(CourseGroup $parent): self
    {
        return $this->state([
            'parent_id' => $parent->id,
            'slug' => fn() => join('-', [
                $parent->slug,
                $this->faker->lexify('??')
            ]),
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
        return [
            'parent_id' => null,
            'order_column' => $this->faker->numberBetween(0, 100),
            'slug' => $this->faker->lexify(
                $this->faker->randomElement(['??', '???', '???'])
            ),
            'title' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $locale . ': ' . $this->faker->words(
                    $this->faker->numberBetween(3, 12),
                    true
                )
            ]),
            'color' => $this->faker->hexColor(),
            'icon' => fn($attributes) => 'https://fakeimg.pl/128x128/' . ltrim($attributes['color'], '#'),
        ];
    }
}
