<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiction',
                'description' => 'Fiction books',
            ],
            [
                'name' => 'Non-fiction',
                'description' => 'Non-fiction books',
            ],
            [
                'name' => 'Drama',
                'description' => 'Drama books',
            ],
            [
                'name' => 'Biography',
                'description' => 'Biography books',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
