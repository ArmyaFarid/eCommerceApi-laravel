<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Article::create([
                'code_article' => $faker->uuid,
                'prix' => $faker->randomFloat(2, 10, 100),
                'libele' => $faker->word,
                'description' => $faker->paragraph,
                'quantite' => $faker->randomNumber(2),
                'img' => $faker->imageUrl(), // You can use a specific method to generate image URLs
            ]);
        }
    }
}
