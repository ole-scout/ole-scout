<?php

namespace FossHaas\Courses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\ActivityGroup>
 */
class ActivityGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'title' => $this->faker->words(
                $this->faker->numberBetween(2, 3),
                true
            ),
        ];
    }
}
