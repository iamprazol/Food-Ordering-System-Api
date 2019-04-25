<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Restaurant\Review as ReviewResource;
use App\Review;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Restaurant;

class ReviewController extends Controller
{
    public function reviewOfRestaurant($id){

        $review = Review::where('restaurant_id', $id)->orderBy('name', 'asc')->get();

        $data = ReviewResource::collection($review);

        return $this->responser($review, $data, 'Reviews');

    }

    public function show()
    {
        $restaurant = Auth::user()->restaurant;
        if ($restaurant) {
            $review = Review::where('restaurant_id', $restaurant->id)->orderBy('restaurant_id', 'asc')->paginate(15);
            return view('restaurant.reviews.show', ['reviews' => $review, 'restaurants' => $restaurant]);
        } else {
            $restaurant = Restaurant::all();
            $review = Review::orderBy('restaurant_id', 'asc')->paginate(15);
            return view('restaurant.reviews.show', ['reviews' => $review, 'restaurants' => $restaurant]);
        }
    }

    public function search(Request $r)
    {
        $id = $r->restaurant_id;

        $review = Review::orderBy('id', 'asc')->where('restaurant_id', $id)->paginate(15);

        $restaurant = Restaurant::all();

        return view('restaurant.reviews.show')->with('restaurants', $restaurant)->with('reviews', $review);

    }

    public function destroy($id){
        $review = Review::where('id', $id)->first();
        $review->delete();

        Session::flash('success', 'Review deleted successfully');
        return redirect()->route('reviews.show');
    }
}
