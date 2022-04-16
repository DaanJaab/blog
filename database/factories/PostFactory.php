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
        $post = $this->faker->unique()->realText(80);
        return [
            'title' => $post,
            'slug' => Str::slug($post),
            'text' => $this->faker->realText(4000),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => PostsCategory::inRandomOrder()->first()->id,
        ];
    }
}
