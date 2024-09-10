<?php

namespace FossHaas\Courses\Database\Factories;

use FossHaas\Courses\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\CoursePrereq>
 */
class CoursePrereqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // course_id, prereq_id
        ];
    }
}
