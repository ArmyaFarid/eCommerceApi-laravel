<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Commande;
use App\Models\Commande_article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class CommandeArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        // Assuming you have existing num_commande and code_article values in your database
        $commandeNumbers = Commande::pluck('num_commande')->toArray();
        $articleCodes = Article::pluck('code_article')->toArray();

//        dd($commandeNumbers);

        foreach (range(1, 5) as $index) {
            $numCommande = $commandeNumbers[0];
            $codeArticle = $faker->randomElement($articleCodes);

            Commande_article::create([
                'num_commande' => $numCommande,
                'code_article' => $codeArticle,
                'quantite' => $faker->randomNumber(2),
                'prixTotal' => $faker->randomFloat(2, 20, 200),
            ]);
        }
    }
}
