<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     private $images = [
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJf5Q_QtpxksvJCiCOB6wRS8P7VO0pc79_1xiZxPRJmOkd7vlDs_OgSi29T_MH55duoMo&usqp=CAU' ,
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQResEl1v0l7ENeM668o9NV9uEBEu5WWuNcROiuYpZz8XPVxMJUFeKCO-tsT5lyGAZz_5E&usqp=CAU',
        'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwEtOY75vWY_OcSoQ4EUVQAdJFvFYpfEWvZA&usqp=CAU'
     ];
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(2,true),
            'thumbnail_url' => $this->images[random_int(0, 2)],
            'author_id' => User::inRandomOrder()->value('id'), // Retrieves a random user ID
            'created_at' => fake()->date(),
            'updated_at' => fake()->date()
        ];
    }
}
