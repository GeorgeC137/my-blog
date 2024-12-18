<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
        $title = fake()->realText(50);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => fake()->realText(5000),
            'active' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
            'thumbnail' => fake()->imageUrl(),
            'user_id' => 1,
        ];
    }
}
