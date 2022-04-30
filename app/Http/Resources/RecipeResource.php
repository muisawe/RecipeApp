<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,

            'name' => $this->name,
            'description' => $this->description,
            'category' => new CategoryResource($this->category),
            'calories' => $this->calories,
            'prep_time' => $this->prep_time,
            'isFavorite' => $this->isFavoritedByUser(),
        ];
    }
}
