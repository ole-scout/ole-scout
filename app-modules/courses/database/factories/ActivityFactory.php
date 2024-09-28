<?php

namespace FossHaas\Courses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\Activity>
 */
class ActivityFactory extends Factory
{
    public function disabled(): self
    {
        return $this->state([
            'is_disabled' => true,
        ]);
    }

    public function withContent($content): self
    {
        return $this->state(fn() => (fn($content) => [
            'content_id' => $content->id,
            'content_type' => $content->getMorphClass(),
            'description' => $content->image
                ? $this->faker->sentence()
                : $this->faker->sentences($this->faker->numberBetween(3, 5), true),
        ])($content()));
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // course_id, activity_group_id, content_id, content_type
            'title' => Str::title($this->faker->words(
                $this->faker->numberBetween(2, 3),
                true
            )),
            'description' => $this->faker->sentence(),
            'is_disabled' => false,
            'is_required' => $this->faker->boolean(),
        ];
    }
}
