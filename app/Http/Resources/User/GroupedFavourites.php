<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupedFavourites extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'restaurants' => collect($this->favourite)->filter(function ($fav) {
                return !is_null($fav->restaurant_id);
            })->map(function ($fav) {
                return [
                    'restaurant_id' => $fav->restaurant_id,
                    'restaurant_name' => optional($fav->restaurant)->restaurant_name,
                    'restaurant_picture' => optional($fav->restaurant)->picture,
                    'restaurant_description' => optional($fav->restaurant)->description,
                    'restaurant_address' => optional($fav->restaurant)->address,
                    'restaurant_delivery_hours' => optional($fav->restaurant)->delivery_hours,
                    'restaurant_minimum_order' => optional($fav->restaurant)->minimum_order,
                    'restaurant_discount' => optional($fav->restaurant)->discount,
                ];
            })->unique('restaurant_id')->values(),

            'foods' => collect($this->favourite)->filter(function ($fav) {
                return !is_null($fav->food_id);
            })->map(function ($fav) {
                return [
                    'food_id' => $fav->food_id,
                    'food_name' => optional($fav->food)->food_name,
                    'picture' => optional($fav->food)->picture,
                    'price' => optional($fav->food)->price,
                    'description' => optional($fav->food)->description,
                    'restaurant_name' => optional($fav->food)->restaurant->restaurant_name,
                ];
            })->unique('food_id')->values(),
        ];
    }
}
