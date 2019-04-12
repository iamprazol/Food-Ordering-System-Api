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

        return $this->responser($favourite, $data,'Favourites');

    }
}
