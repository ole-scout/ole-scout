<?php

namespace FossHaas\Courses\Database\Factories;

use FossHaas\Courses\Enums\Access;
use FossHaas\Courses\Models\CourseGroup;
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
            'slug' => function ($attributes) {
                if ($attributes['course_group_id']) {
                    $courseGroup = CourseGroup::find($attributes['course_group_id']);
                    return join('-', [
                        $courseGroup->slug,
                        sprintf('%02d', $courseGroup->courses()->count() + 1)
                    ]);
                }
                return join('-', [
                    $this->faker->lexify($this->faker->randomElement(['??', '???', '???'])),
                    sprintf('%02d', $this->faker->randomNumber(2))
                ]);
            },
            'language' => $this->faker->randomElement($locales),
            'title' => $this->faker->words(
                $this->faker->numberBetween(2, 3),
                true
            ),
            'description' => $this->faker->paragraph(),
            'color' => $this->faker->hexColor(),
            'author' => null, // currently serves no purpose
            'clearance' => null, // currently serves no purpose
            'icon' => fn($attributes) => 'https://fakeimg.pl/128x128/' . ltrim($attributes['color'], '#'),
            'is_published' => true,
            'access' => $this->faker->randomElement(Access::cases()),
            'cert' => null, // TODO
        ];
    }
}
