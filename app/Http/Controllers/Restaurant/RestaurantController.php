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

        return $this->responser($restaurant, $data, 'restaurants');
    }

    public function searchRestaurant($name){

        $restaurant = Restaurant::where('restaurant_name','like',"%$name%")->orderBy('restaurant_name', 'asc')->get();

        $data = RestaurantResource::collection($restaurant);

        return $this->responser($restaurant, $data,'restaurants');

    }

    public function restaurantById($id){

        $restaurant = Restaurant::where('id', $id)->orderBy('restaurant_name', 'asc')->get();

        $data = RestaurantResource::collection($restaurant);

        return $this->responser($restaurant, $data,'restaurant');
    }
}
