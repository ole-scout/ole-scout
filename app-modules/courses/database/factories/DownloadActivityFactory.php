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
            'image' => 'https://place-hold.it/640/360/' . ltrim($this->faker->hexColor(), '#'),
            'filename' => $this->faker->word(), // TODO
        ];
    }
}
