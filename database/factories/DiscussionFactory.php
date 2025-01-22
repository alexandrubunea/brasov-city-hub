<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discussion>
 */
class DiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => implode(' ', fake()-> sentences(5)),
            'user_id' => User::inRandomOrder()->first()->id,
            'cultural_event' => $this->faker->boolean,
            'sport_event' => $this->faker->boolean,
            'movie_night' => $this->faker->boolean,
            'party' => $this->faker->boolean,
            'show' => $this->faker->boolean,
            'concert' => $this->faker->boolean,
            'other' => $this->faker->boolean
        ];
    }
}
