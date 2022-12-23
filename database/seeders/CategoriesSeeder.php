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
            ['title' => 'TV','description' => 'TV Shows Questions'],
            ['title' => 'Music','description' => 'Music Questions'],
            ['title' => 'Pop Culture','description' => 'Pop culture Questions'],
            ['title' => 'Geography','description' => 'Geography Questions'],
            ['title' => 'Language','description' => 'Language Questions'],
            ['title' => 'Symbols','description' => 'Semiotics Questions'],
        ];

        foreach($categories as $category){
            Category::updateOrCreate($category);
        }
    }
}