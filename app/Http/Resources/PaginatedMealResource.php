<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MealResource;

class PaginatedMealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $queryParams = $request->query();
        $links = [
            'prev' => null,
            'next' => null,
            'self' => $this->resource->url($this->resource->currentPage()) . '?' . http_build_query($queryParams),
        ];

        if ($this->resource->previousPageUrl()) {
            $links['prev'] = $this->resource->previousPageUrl() . '?' . http_build_query($queryParams);
        }

        if ($this->resource->nextPageUrl()) {
            $links['next'] = $this->resource->nextPageUrl() . '?' . http_build_query($queryParams);
        }


        return [
            'meta' => [
                'currentPage' => $this->resource->currentPage(),
                'totalItems' => $this->resource->total(),
                'itemsPerPage' => $this->resource->perPage(),
                'totalPages' => $this->resource->lastPage(),
            ],
            'data' => MealResource::collection($this->resource->getCollection()),
            'links' => $links,
        ];
    }
}
