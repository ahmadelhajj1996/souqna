<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::inRandomOrder()->limit(5)->get();

        foreach ($users as $user) {
            \App\Models\Seller::create([
                'user_id' => $user->id,
                'store_name' => fake()->company(),
                'description' => fake()->paragraph(),
                'logo' => 'logos/default.png',
                'banner' => 'banners/default.png',
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'rating' => rand(3, 5)
            ]);
        }
    }
}