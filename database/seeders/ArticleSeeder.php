<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,20) as $index){
            DB::table("articles")->insert([
                "title" => $faker->sentence(),
                "body" => $faker->paragraph(),
                "category_id" => rand(1,5)
            ]);
        }
    }
}
