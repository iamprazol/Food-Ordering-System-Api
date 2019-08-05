<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Restaurant\Food as FoodResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'restaurant' => $this->restaurant_id,
            'category' => $this->category_name,
            'foods' => FoodResource::collection($this->food),
        ];
    }
}
