<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CommandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $userId = User::first()->id;

        foreach (range(1, 5) as $index) {
            $username = $faker->userName;
            Commande::create([
                'id' => Str::uuid(),
                'num_commande' => Str::uuid(),
                'prixTTC' => $faker->randomFloat(2, 10, 100),
                'date_livraison' => $faker->dateTimeBetween('now', '+1 month'), // Delivery date within the next month
                'user_id'=>$userId,
            ]);
        }
    }
}
