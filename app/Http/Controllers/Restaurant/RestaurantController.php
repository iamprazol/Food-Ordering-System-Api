<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Http\Resources\Restaurant\Restaurant as RestaurantResource;

class RestaurantController extends Controller
{
    public function index(){

        $restaurant = Restaurant::orderBy('restaurant_name', 'asc')->get();

        $data = RestaurantResource::collection($restaurant);

        $num = count($restaurant);

        if($num > 0){
            return $this->responser($data, '200', 'All Restaurant are listed');
        } else {
            return $this->responser($data, 404, 'Restaurants cannot be found');
        }

    }

    public function restaurantById($id){

        $restaurant = Restaurant::where('id', $id)->orderBy('restaurant_name', 'asc')->get();

        $data = RestaurantResource::collection($restaurant);

        $num = count($restaurant);

        if($num > 0){
            return $this->responser($data, '200', 'Restaurant with specific id is found');
        } else {
            return $this->responser($data, 404, 'Restaurant with specific id cannot be found');
        }

    }
}
