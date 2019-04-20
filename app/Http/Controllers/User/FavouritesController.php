<?php

namespace App\Http\Controllers\User;

use App\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Favourites;
use App\Http\Resources\User\Favourites as FavouriteResource;
use Illuminate\Support\Facades\Auth;


class FavouritesController extends Controller
{

    public function food($id){
        $favourite = Favourites::create([
            'user_id' => Auth::id(),
            'food_id' => $id
        ]);

        $data = new FavouriteResource($favourite);

        return response()->json(['data' => $data,'status' => 200,'message' => 'Favourite Food added successfully'],200);
    }

    public function restaurant($id){
        $favourite = Favourites::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $id
        ]);

        $data = new FavouriteResource($favourite);
        return response()->json(['data' => $data,'status' => 200,'message' => 'Favourite Restaurant added successfully'],200);
    }

    public function myFavouriteFood(){

        $favourite = Favourites::where('user_id', Auth::id())->where('restaurant_id', null)->get();

        $data = FavouriteResource::collection(collect($favourite));
        return $this->responser(collect($favourite), $data, 'Favourite Food');

    }

    public function myFavouriteRestaurant(){

        $favourite = Favourites::where('user_id', Auth::id())->where('food_id', null)->get();

        $data = FavouriteResource::collection(collect($favourite));
        return $this->responser(collect($favourite), $data, 'Favourite Restaurant');

    }

    public function deleteFavouriteFood($id){

        $favourite = Favourites::where(['user_id'=> Auth::id(),'food_id'=> $id])->first();
        if(!$favourite){
            abort('404');
        }
        $favourite->delete();

        $data = new FavouriteResource($favourite);
        return response()->json(['data' => $data,'status' => 200,'message' => 'Food removed from favourite food successfully'],200);

    }


    public function deleteFavouriteRestaurant($id){

        $favourite = Favourites::where(['user_id'=> Auth::id(),'restaurant_id'=> $id])->first();
        if(!$favourite){
            abort('404');
        }
        $favourite->delete();

        $data = new FavouriteResource($favourite);
        return response()->json(['data' => $data,'status' => 200,'message' => 'Restaurant removed from favourite restaurant successfully'],200);

    }
}
