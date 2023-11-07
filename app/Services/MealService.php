<?php

namespace App\Services;

use App\Models\Meal;
use App\Http\Resources\PaginatedMealResource;
use Illuminate\Pagination\LengthAwarePaginator;


class MealService{
    public function data(array $request)
    {
        $perPage = $request['per_page'] ?? 10; 
        $page = $request['page'] ?? 1;
        $with = isset($request['with']) ? explode(',', $request['with']) : [];
        $tagovi = isset($request['tags']) ? explode(',', $request['tags']) : [];
        $locale = $request['lang'];
        app()->setLocale($locale);
        
        $query = Meal::with($with);

        if(isset($request['category'])) {
            $query = $this->filterMealsByCategory($query, $request['category']);
        }

        if(isset($request['diff_time'])) {
            $meals = $this->modifyStatus($query, $request['diff_time'],$perPage,$page);
        } else {
            $meals = $query->whereNull('deleted_at')->paginate($perPage,['*'],'page',$page);
        }

        return new PaginatedMealResource($meals);

    }

    private function modifyStatus($query,$diffTime,$perPage,$page){
        $meals = $query->where(function ($query) use ($diffTime) {
            $query->where(function ($query) use ($diffTime) {
                $query->whereRaw('UNIX_TIMESTAMP(created_at) > ?', [$diffTime])
                    ->orWhereRaw('UNIX_TIMESTAMP(updated_at) > ?', [$diffTime])
                    ->orWhereRaw('UNIX_TIMESTAMP(deleted_at) > ?', [$diffTime]);
            });
        })->paginate($perPage,['*'],'page',$page);

        $meals->each(function ($meal) use ($diffTime) {
            if ($diffTime < strtotime($meal->deleted_at)) {
                $meal->status = "deleted";
            } elseif ($diffTime < strtotime($meal->updated_at) && strtotime($meal->updated_at) != strtotime($meal->created_at)) {
                $meal->status = "modified";
            } elseif ($diffTime < strtotime($meal->created_at)) {
                $meal->status = "created";
            }
        });

        return $meals;
    }

    private function filterMealsByCategory($query,$category){
        switch ($category) {
            case 'NULL':
                return $query->whereNull('category_id');
            case '!NULL':
                return $query->whereNotNull('category_id');
            default:
                return $query->where('category_id', $category);
        }
    }
}
