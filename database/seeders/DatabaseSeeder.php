<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // before run seeder, first turn off Post, and Comment observer's in AppServiceProvider!!
        $this->call([
            PostsCategorySeeder::class
        ]);
        User::factory(30)->create();
        Post::factory(200)->create();
        Comment::factory(700)->create();
    }
}
