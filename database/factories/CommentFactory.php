<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $create_date = $this->faker->dateTimeBetween('-60 days', '-20 days');
        return [
            'content' => $this->faker->realText(4000),
            'created_at' => $create_date,
            'updated_at' => $this->faker->randomElement([$create_date, $create_date, $this->faker->dateTimeBetween('-19 days', '-5 days')]),
            'user_id' => User::inRandomOrder()->first()->id,
            'post_id' => Post::inRandomOrder()->first()->id,
        ];
    }
}
