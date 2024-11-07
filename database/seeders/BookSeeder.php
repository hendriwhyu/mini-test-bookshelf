<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'category_id' => 1,
            'title' => 'Book 1',
            'author' => 'Author 1',
            'publisher' => 'Publisher 1',
            'year' => 2022,
            'description' => 'Description 1',
            'cover' => 'https://imgs.search.brave.com/nL4B4Z-uhYPTTs6t-9ZY_4WKOexC1PXTnV8sYLpstHY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvOTI0/MzkwMDQvcGhvdG8v/dGF0dGVyZWQtY292/ZXIuanBnP3M9NjEy/eDYxMiZ3PTAmaz0y/MCZjPU5FeHdzSEll/SXh4QkdqcTRWMzhy/UXZjMW1mdVlZU0Za/RHZBSkROZzdXMzg9',
        ]);
    }
}
