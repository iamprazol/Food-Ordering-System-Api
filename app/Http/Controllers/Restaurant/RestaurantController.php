<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Http\Resources\Restaurant\Restaurant as RestaurantResource;
use App\Cusine;

class RestaurantController extends Controller
{

    public function searchRestaurant(Request $filters){

        $restaurant = (new Restaurant)->newQuery();

        if($filters->has('name')){
            $restaurant->where('restaurant_name','like', '%'.$filters->input('name').'%');
        }

        if($filters->has('id')){
            $restaurant->where('id',$filters->input('id'));
        }

        if($filters->has('address')){
            $restaurant->where('address', $filters->input('address'));
        }

        if($filters->has('cusine')) {
            $cusine = Cusine::where('name', $filters->input('cusine'))->first();
            if ($cusine) {
                $restaurant->where('cusine_id', $cusine->id);
            }
        }

        if($filters->has('lat') && $filters->has('lon')){
            $latitude = $filters->input('lat');
            $longitude = $filters->input('lon');
            $restaurant = $this->closest($latitude, $longitude, 20);
        }

        $data = RestaurantResource::collection($restaurant->get());

        return $this->responser($restaurant->get(), $data,'restaurants');

    }


}
