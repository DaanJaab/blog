<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $categories = ['Pojazdy i łodzie', 'Samoloty i śmigłowce', 'AGD', 'RTV', 'Odzież', 'Polityka', 'Świat', 'Przyroda', 'Inne'];
        for ($i = 0; $i < 9; $i++) {
            DB::table('posts_categories')->insert([
                'name' => $categories[$i],
                'slug' => Str::slug($categories[$i]),
                'description' => $faker->realText(600)
            ]);
        }
    }
}
