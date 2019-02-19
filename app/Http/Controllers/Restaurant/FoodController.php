<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\Food as FoodResource;
use App\Food;


class FoodController extends Controller
{
    public function foodOfRestaurant($id){

        $food = Food::where('restaurant_id', $id)->orderBy('food_name', 'asc')->get();

        $data = FoodResource::collection($food);

        $num = count($food);

        if($num > 0){
            return $this->responser($data, 200, 'Food in a specific restaurant is listed');
        } else {
            return $this->responser($data, 404, 'Food in a specific restaurant id cannot be found');
        }

    }
}
