<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MealTranslation;
use App\Models\Meal;

class MealTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = config('translatable.locales');
        $meals = Meal::all();
        
        foreach ($meals as $meal) {
            foreach ($locales as $locale) {
                MealTranslation::factory()->create([
                    'meal_id' => $meal->id,
                    'locale' => $locale,
                ]);
            }
        }
    }
}
