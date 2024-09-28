<?php

namespace FossHaas\Courses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\WeblinkActivity>
 */
class WeblinkActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->boolean(10) ? 'https://picsum.photos/seed/' . random_int(0, 999999) . '/640/360/' : null,
            'url' => $this->faker->url(),
        ];
    }
}
