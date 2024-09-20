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
            'slug' => function ($attributes) {
                if ($attributes['parent_id']) {
                    return join('-', [
                        CourseGroup::find($attributes['parent_id'])->slug,
                        $this->faker->lexify('??')
                    ]);
                }
                return $this->faker->lexify(
                    $this->faker->randomElement(['??', '???', '???'])
                );
            },
            'title' => Arr::mapWithKeys($locales, fn($locale) => [
                $locale => $locale . ': ' . $this->faker->words(
                    $this->faker->numberBetween(2, 3),
                    true
                )
            ]),
            'color' => $this->faker->hexColor(),
            'icon' => fn($attributes) => 'https://fakeimg.pl/128x128/' . ltrim($attributes['color'], '#'),
        ];
    }
}
