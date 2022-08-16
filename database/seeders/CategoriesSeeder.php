<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['title' => 'Math','description' => 'Math questions'],
            ['title' => 'Science','description' => 'Science questions'],
            ['title' => 'History','description' => 'History questions'],
            ['title' => 'General Knowledge','description' => 'General Knowledge questions'],
            ['title' => 'Trivia','description' => 'Trivia questions'],
        ];

        foreach($categories as $category){
            Category::create($category);
        }
    }
}
