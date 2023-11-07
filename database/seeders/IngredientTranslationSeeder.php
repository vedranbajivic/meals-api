<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\IngredientTranslation;

class IngredientTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = config('translatable.locales');
        $ingredients = Ingredient::all();
        
        foreach ($ingredients as $ingredient) {
            foreach ($locales as $locale) {
                IngredientTranslation::factory()->create([
                    'ingredient_id' => $ingredient->id,
                    'locale' => $locale,
                ]);
            }
        }
    }
}
