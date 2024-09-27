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
    protected static $counters = [];
    public function unpublished(): self
    {
        return $this->state([
            'is_published' => false,
        ]);
    }

    public function withCourseGroup(CourseGroup $courseGroup): self
    {
        $course_group_id = (string) $courseGroup->id;
        return $this->state([
            'course_group_id' => $course_group_id,
            'slug' => fn() => join('-', [
                $courseGroup->slug,
                sprintf(
                    '%02d',
                    isset(static::$counters[$course_group_id])
                        ? ++static::$counters[$course_group_id]
                        : static::$counters[$course_group_id] = 1
                )
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
            'course_group_id' => null,
            'slug' => join('-', [
                $this->faker->lexify($this->faker->randomElement(['??', '???', '???'])),
                sprintf('%02d', $this->faker->randomNumber(2))
            ]),
            'language' => $this->faker->randomElement($locales),
            'title' => $this->faker->words(
                $this->faker->numberBetween(3, 12),
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
