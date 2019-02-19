<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Favourites;
use App\Http\Resources\User\Favourites as FavouriteResource;


class FavouritesController extends Controller
{
    public function favouriteByUser($id){

        $favourite = Favourites::where('user_id', $id)->get();

        $data = FavouriteResource::collection($favourite);

        $num = count($favourite);

        if($num > 0){
            return $this->responser($data,200,"Favourite items with specific user id is found");
        } else {
            return $this->responser($data,404,"Favourite with specific user id cannot be found");
        }
    }
}
