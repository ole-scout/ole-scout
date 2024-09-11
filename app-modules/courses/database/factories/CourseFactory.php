<?php

namespace FossHaas\Courses\Database\Factories;

use FossHaas\Courses\Enums\Access;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\Course>
 */
class CourseFactory extends Factory
{
    public function unpublished(): self
    {
        return $this->state([
            'is_published' => false,
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
            'course_group_id' => null,
            'slug' => $this->faker->slug(),
            'language' => fn() => $this->faker->randomElement($locales),
            'title' => fn() => $this->faker->words(
                $this->faker->numberBetween(2, 3),
                true
            ),
            'description' => $this->faker->paragraph(),
            'color' => $this->faker->hexColor(),
            'author' => null, // currently serves no purpose
            'clearance' => null, // currently serves no purpose
            'icon' => fn($attributes) => 'https://place-hold.it/128/128/' . ltrim($attributes['color'], '#'),
            'is_published' => true,
            'access' => $this->faker->randomElement(Access::cases()),
            'cert' => null, // TODO
        ];
    }
}
