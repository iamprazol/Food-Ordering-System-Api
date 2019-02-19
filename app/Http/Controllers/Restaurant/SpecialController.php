<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\Special as SpecialResource;
use App\Special;

class SpecialController extends Controller
{
    public function specialOfRestaurant($id){

        $special = Special::where('restaurant_id', $id)->get();

        $data = SpecialResource::collection($special);

        $num = count($special);

        if($num > 0){
            return $this->responser($data, 200, 'Special item in a specific restaurant is listed');
        } else {
            return $this->responser($data, 404, 'Special item in a specific restaurant cannot be found');
        }

    }
}
