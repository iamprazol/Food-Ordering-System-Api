<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Restaurant\Review as ReviewResource;
use App\Review;

class ReviewController extends Controller
{
    public function reviewOfRestaurant($id){

        $review = Review::where('restaurant_id', $id)->orderBy('name', 'asc')->get();

        $data = ReviewResource::collection($review);

        $num = count($review);

        if($num > 0){
            return $this->responser($data, 200, 'Review of a specific restaurant is listed');
        } else {
            return $this->responser($data, 404, 'Review of a specific restaurant cannot be found');
        }

    }
}
