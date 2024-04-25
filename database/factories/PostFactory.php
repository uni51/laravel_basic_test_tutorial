<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->realText(10),
            'body' => fake()->realText(20),
            'status' => 1,
        ];
    }

    public function closed()
    {
        return $this->state(fn (array $attrs) => [
            'status' => 0,
        ]);
    }
}
