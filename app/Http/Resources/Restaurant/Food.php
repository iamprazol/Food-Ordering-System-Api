<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Resources\Json\JsonResource;

class Food extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

        return [
            'id' => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'category_id' => $this->category_id,
            'restaurant_name' => $this->restaurant->restaurant_name,
            'food_name' => $this->food_name,
            'picture' => $this->picture,
            'price' => $this->price,
            'description' => $this->description,
        ];
    }
}
