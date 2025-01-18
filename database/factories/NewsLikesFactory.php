<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\NewsArticle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsLikes>
 */
class NewsLikesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'news_article_id' => NewsArticle::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
