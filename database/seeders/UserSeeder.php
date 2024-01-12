<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            $username = $faker->userName;
            User::create([
                'id' => Str::uuid(),
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'username' => $username,
                'password' => Hash::make('pwd_'.$username), // Default password for all users
                'img' => $faker->imageUrl($width = 200, $height = 200, 'people'), // Adjust width, height, and category as needed
            ]);
        }
    }
}
