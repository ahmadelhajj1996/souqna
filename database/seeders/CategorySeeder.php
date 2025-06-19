<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Electronics', 'Cars', 'Real Estate', 'Jobs'];
        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }
    }
}