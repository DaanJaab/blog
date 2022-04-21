<?php

namespace Database\Factories;

use App\Models\PostsCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        $title = $this->faker->unique()->realText(80);
        $create_date = $this->faker->dateTimeBetween('-60 days', '-20 days');
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->realText(4000),
            'created_at' => $create_date,
            'updated_at' => $this->faker->randomElement([$create_date, $create_date, $this->faker->dateTimeBetween('-19 days', '-5 days')]),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => PostsCategory::inRandomOrder()->first()->id,
        ];
    }
}
