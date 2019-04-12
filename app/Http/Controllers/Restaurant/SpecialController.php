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

        return $this->responser($special, $data, 'Special');

    }
}
