<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Tag;

class MealTagPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meals = Meal::all();
        foreach ($meals as $meal) {
            $maxElements = Tag::count();
            $numberOfElements = rand(1, $maxElements);
            $tags = Tag::inRandomOrder()->take($numberOfElements)->get();
            foreach ($tags as $tag){
                $meal->tags()->attach($tag->id);
            }
        }
    }
}
