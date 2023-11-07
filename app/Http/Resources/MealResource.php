<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ];
        if ($this->relationLoaded('tags')) {
            $data['tags'] = TagResource::collection($this->tags);
        }

        if ($this->relationLoaded('category')) {
            $data['category'] = new CategoryResource($this->category);
        }

        if ($this->relationLoaded('ingredients')) {
            $data['ingredients'] = IngredientResource::collection($this->ingredients);
        }

        return $data;
    }
}
