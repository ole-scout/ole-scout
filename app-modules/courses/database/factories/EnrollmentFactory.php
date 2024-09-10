<?php

namespace FossHaas\Courses\Database\Factories;

use App\Models\User;
use FossHaas\Courses\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    public function expired(): self
    {
        return $this->state([
            'expires_at' =>  fn() => $this->faker->dateTimeBetween('-2 years', 'now'),
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
            'expires_at' =>  fn() => $this->faker->dateTimeBetween('+6 hours', '+1 year'),
        ];
    }
}
