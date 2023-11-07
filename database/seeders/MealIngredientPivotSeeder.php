<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Ingredient;

class MealIngredientPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meals = Meal::all();
        foreach ($meals as $meal) {
            $maxElements = Ingredient::count();
            $numberOfElements = rand(1, $maxElements);
            $ingredients = Ingredient::inRandomOrder()->take($numberOfElements)->get();
            foreach ($ingredients as $ingredient){
                $meal->ingredients()->attach($ingredient->id);
            }
        }
    }
}
