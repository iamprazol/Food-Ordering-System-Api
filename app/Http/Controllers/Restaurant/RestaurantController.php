<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Http\Resources\Restaurant\Restaurant as RestaurantResource;
use App\Cusine;
use App\Manager;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;


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

    public function createRestaurant(Request $request){
        $manager = Manager::where('user_id', Auth::id())->first();

        if(!$manager){

            $validator = Validator::make($request->all(), [
                'restaurant_name' => 'required',
                'description' => 'required',
                'delivery_hours' => 'required',
                'minimum_order' => 'required',
                'cover_pic' => 'required',
                'picture' => 'required',
                'address' => 'required'
            ]);
            if($validator->fails()){
                return response()->json(['error' => $validator->errors()], 401);
            }

            $restaurant = Restaurant::create($request->all());

            Manager::create([
                'user_id' => Auth::id(),
                'restaurant_id' => $restaurant->id
            ]);

            $data = new RestaurantResource($restaurant);
            return $this->responser($restaurant, $data, 'Restaurant Created');

        } else {
            $restaurant = Restaurant::where('id', $manager->restaurant_id)->first();
            $data = new RestaurantResource($restaurant);
            return response()->json(['data' =>$data, 'message' => 'You already have one restaurant'], 406);
        }
    }

}
