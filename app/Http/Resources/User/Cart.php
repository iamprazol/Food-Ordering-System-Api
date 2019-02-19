<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class Cart extends JsonResource
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
            'user_id' => $this->user_id,
            'user_name' => $this->user->first_name.' '.$this->user->first_name,
            'restaurant_id' => $this->restaurant_id,
            'restaurnat_name' => $this->restaurant->restaurant_name,
            'food_id' => $this->food_id,
            'food_name' => $this->food->food_name,
            'price' => $this->price
        ];
    }
}
