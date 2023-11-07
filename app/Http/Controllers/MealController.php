<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\UpdateMealRequest;
use Illuminate\Http\Request;
use App\Http\Resources\MealResource;
use App\Http\Requests\MealRequest;
use App\Services\MealService;


class MealController extends Controller
{
    private MealService $mealService;

    public function __construct(MealService $mealService)
    {
        $this->mealService= $mealService;
    }

    public function data(MealRequest $request)
    {
        return $this->mealService->data($request->validated());
    }
}
