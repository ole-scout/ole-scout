<?php

namespace FossHaas\Courses\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\FossHaas\Courses\Models\DownloadActivity>
 */
class DownloadActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => $this->faker->boolean(40) ? 'https://picsum.photos/seed/' . random_int(0, 999999) . ($this->faker->boolean(30) ? '/640/' . round(sqrt(2) * 640) . '/' : '/640/360/') : null,
            'filename' => fn($attributes) => implode('_', $this->faker->words(2)) . ($attributes['image'] ? '.jpg' : '.txt'), // TODO
        ];
    }
}
