<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;

class CategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = config('translatable.locales');
        $categories = Category::all();
        
        foreach ($categories as $category) {
            foreach ($locales as $locale) {
                CategoryTranslation::factory()->create([
                    'category_id' => $category->id,
                    'locale' => $locale,
                ]);
            }
        }
    }
}
