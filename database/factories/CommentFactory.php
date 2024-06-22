<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Article;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->sentence(),
            'author_id' => User::inRandomOrder()->value('id'),
            'article_id' => Article::inRandomOrder()->value('id'),
            'created_at' => fake()->date(),
            'updated_at' => fake()->date()
        ];
    }
}
