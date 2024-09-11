<?php

namespace FossHaas\Courses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // course_id, activity_group_id, activity_id, activity_type
            'title' => $this->faker->words(
                $this->faker->numberBetween(2, 3),
                true
            ),
            'description' => $this->faker->sentence(),
            'is_disabled' => false,
            'is_required' => $this->faker->boolean(),
        ];
    }
}
