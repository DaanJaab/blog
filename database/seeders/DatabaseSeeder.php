<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        $this->call([
            PostsCategorySeeder::class
        ]);
        User::withoutEvents(function () {
            User::factory(30)->create();
        });
        Post::withoutEvents(function () {
            Post::factory(200)->create();
        });
        Comment::withoutEvents(function () {
            Comment::factory(700)->create();
        });
    }
}
