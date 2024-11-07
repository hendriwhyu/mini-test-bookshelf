<?php

namespace Database\Seeders;

use App\Models\Book;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(range(1, 5) as $i) {
            Book::create([
                'category_id' => rand(1, 4),
                'title' => 'Book '. $i,
                'author' => 'Author '. $i,
                'publisher' => 'Publisher '. $i,
                'release_date' => new DateTime('2023-01-01'),
                'isbn' => Str::random(10),
                'description' => 'Description...',
                'cover' => 'https://imgs.search.brave.com/nL4B4Z-uhYPTTs6t-9ZY_4WKOexC1PXTnV8sYLpstHY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tZWRp/YS5pc3RvY2twaG90/by5jb20vaWQvOTI0/MzkwMDQvcGhvdG8v/dGF0dGVyZWQtY292/ZXIuanBnP3M9NjEy/eDYxMiZ3PTAmaz0y/MCZjPU5FeHdzSEll/SXh4QkdqcTRWMzhy/UXZjMW1mdVlZU0Za/RHZBSkROZzdXMzg9',
            ]);
        }
    }
}
