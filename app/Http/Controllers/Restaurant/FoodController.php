<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\Food as FoodResource;
use App\Food;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Category;
use Image;
use Session;

class FoodController extends Controller
{
    public function foodOfRestaurant($id){

        $food = Food::where('restaurant_id', $id)->orderBy('food_name', 'asc')->get();

        $data = FoodResource::collection($food);

        return $this->responser($food, $data, 'Foods');

    }

    public function foodByCategory($id){

        $food = Food::where('category_id', $id)->orderBy('food_name', 'asc')->get();

        $data = FoodResource::collection($food);

        return $this->responser($food, $data, 'Foods');

    }

    public function show()
    {
        $restaurant = Auth::user()->restaurant;
        if ($restaurant) {
            $food = Food::where('restaurant_id', $restaurant->id)->orderBy('food_name', 'asc')->paginate(15);
            return view('restaurant.foods.show', ['foods' => $food, 'restaurants' => $restaurant]);
        } else {
            $restaurant = Restaurant::all();
            $food = Food::orderBy('restaurant_id', 'asc')->paginate(15);
            return view('restaurant.foods.show', ['foods' => $food, 'restaurants' => $restaurant]);
        }
    }

    public function search(Request $r)
    {
        $id = $r->restaurant_id;

        $food = Food::orderBy('id', 'asc')->where('restaurant_id', $id)->paginate(15);

        $restaurant = Restaurant::all();

        return view('restaurant.foods.show')->with('restaurants', $restaurant)->with('foods', $food);

    }

    public function create($id){
        $restaurant = Restaurant::find($id);
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('restaurant.foods.create')->with('restaurants', $restaurant)->with('categories', $category);
    }

    public function storeFood(Request $request){

        $this->Validate($request,[
            'food_name' => 'required|string|min:2',
            'picture' =>'required|max:15360',
        ]);

        $picfilename = time() . '.' . $request->file('picture')->getClientOriginalExtension();
        $picpath = public_path('/images/food/' . $picfilename);
        Image::make($request->file('picture'))->save($picpath);

        Food::create([
            'restaurant_id' => $request->restaurant_id,
            'category_id' => $request->category_id,
            'food_name' => $request->food_name,
            'price' => $request->price,
            'picture' => $picfilename,
        ]);

        Session::flash('success', 'Food details added successfully');
        return redirect()->route('food.show');
    }

    public function edit($id){
        $food = Food::find($id);
        return view('restaurant.foods.edit')->with('foods', $food);
    }

    public function updateFood(Request $request, $id){

        $this->Validate($request,[
            'food_name' => 'required|string|min:2',
            'picture' =>'required|max:15360',
        ]);

        $picfilename = time() . '.' . $request->file('picture')->getClientOriginalExtension();
        $picpath = public_path('/images/food/' . $picfilename);
        Image::make($request->file('picture'))->save($picpath);

        $food = Food::find($id);
        $food->restaurant_id = $request->restaurant_id;
        $food->category_id = $request->category_id;
        $food->food_name = $request->food_name;
        $food->price = $request->price;
        $food->picture = $picfilename;
        $food->save();

        Session::flash('success', 'Food details updated successfully');
        return redirect()->route('food.show');
    }

    public function destroy($id){
        $food = Food::where('id', $id)->first();
        $food->delete();

        Session::flash('success', 'Food details deleted successfully');
        return redirect()->route('food.show');
    }
}
