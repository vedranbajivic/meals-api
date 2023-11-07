<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        if (random_int(0, 1) === 1) {
            $categories = Category::pluck('id')->toArray();
            $category = $faker->randomElement($categories);
        }else{
            $category = null;
        }

        return [
            'category_id' => $category,
            'status' => 'created',
        ];
    }
}
