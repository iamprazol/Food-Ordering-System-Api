<?php

namespace App\Http\Controllers\Restaurant;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\Http\Resources\Restaurant\Restaurant as RestaurantResource;
use App\Http\Resources\Restaurant\Category as CategoryResource;
use App\Http\Controllers\Restaurant\FoodController;
use App\Cusine;
use App\Manager;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Image;
use Session;
use App\Food;
use App\Category;


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
            $restaurant->where('address', 'like', '%'. $filters->input('address').'%');
        }

        if($filters->has('cusine')) {
            $cusine = Cusine::where('name', $filters->input('cusine'))->first();
            if ($cusine) {
                $restaurant->where('cusine_id', $cusine->id);
            }
        }

        if($filters->has('category')) {
            $category = Category::where('id', $filters->input('category'))->first();

            if ( $category ) {
                $foodsInCategory = Food::where('category_id', $category->id)->orderBy('food_name', 'asc')->get();

                $restaurantIdArray = array();

                foreach ( $foodsInCategory as $food ) {
                    if( !in_array( $food->restaurant_id, $restaurantIdArray ) ) {
                        $restaurantIdArray[] = $food->restaurant_id;
                    }
                }

                $restaurant->whereIn('id', $restaurantIdArray);
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

    public function index(Restaurant $model){
        return view('restaurant.detail.show', ['restaurants' => $model->paginate(15)]);
    }

    public function edit($id){
        $manager = Restaurant::where('user_id', $id)->first();
        $user  = User::where('id', $id)->first();
        if(!$manager){
            return view('restaurant.detail.create')->with('users', $user);
        } else {
            return view('restaurant.detail.edit')->with('restaurant', $manager);
        }
    }

    public function storeRestaurant(Request $request, $id){

        $this->Validate($request,[
            'restaurant_name' => 'required|string|min:2',
            'description' => 'required|string|min:30',
            'picture' =>'required|max:15360',
            'cover_pic' => 'required|max:15360',
            'address' => 'required'
        ]);

        $picfilename = time() . '.' . $request->file('picture')->getClientOriginalExtension();
        $picpath = public_path('/images/restaurant/' . $picfilename);
        Image::make($request->file('picture'))->save($picpath);

        $coverfilename = time() . '.' . $request->file('cover_pic')->getClientOriginalExtension();
        $path = public_path('/images/restaurant/' . $coverfilename);
        Image::make($request->file('cover_pic'))->save($path);

        $restaurant = Restaurant::create([
            'user_id' => $id,
            'restaurant_name' => $request->restaurant_name,
            'description' => $request->description,
            'minimum_order' => $request->minimum_order,
            'picture' => $picfilename,
            'cover_pic' => $coverfilename,
            'address' => $request->address,
            'delivery_from' => Carbon::parse($request->delivery_from)->format('H:i:s'),
            'delivery_to' => Carbon::parse($request->delivery_)->format('H:i:s'),
            'discount' => $request->discount,
            'additional_charge' => $request->additional_charge,
            'vat' => $request->vat,
        ]);

        Session::flash('success', 'Restaurant details added successfully');
        return redirect()->route('restaurant.edit', ['id' => $restaurant->user_id]);
    }

    public function update(Request $request, $id)
    {
        $this->Validate($request, [
            'restaurant_name' => 'required|string|min:2',
            'description' => 'required|string|min:30',
            'picture' => 'required|max:15360',
            'cover_pic' => 'required|max:15360',
            'address' => 'required'
        ]);

        $picfilename = time() . '.' . $request->file('picture')->getClientOriginalExtension();
        $picpath = public_path('/images/restaurant/' . $picfilename);
        Image::make($request->file('picture'))->save($picpath);

        $coverfilename = time() . '.' . $request->file('cover_pic')->getClientOriginalExtension();
        $path = public_path('/images/restaurant/' . $coverfilename);
        Image::make($request->file('cover_pic'))->save($path);

        $restaurant = Restaurant::find($id);
        $restaurant->restaurant_name = $request->restaurant_name;
        $restaurant->description = $request->description;
        $restaurant->delivery_from = $request->delivery_from;
        $restaurant->delivery_to = $request->delivery_to;
        $restaurant->minimum_order = $request->minimum_order;
        $restaurant->discount = $request->discount;
        $restaurant->vat = $request->vat;
        $restaurant->additional_charge = $request->additional_charge;
        $restaurant->address = $request->address;
        $restaurant->cover_pic = $coverfilename;
        $restaurant->picture = $picfilename;

        $restaurant->save();

        Session::flash('success', 'Restaurant details updated successfully');
        if (Auth::user()->role_id == 1) {
            return redirect()->route('restaurant.show');
        } else {
            return redirect()->route('restaurant.edit', ['id' => $restaurant->user_id]);
        }
    }

    public function viewRestaurant( $id ) {
        $restaurant = Restaurant::where('id', $id )->get();

        $data = RestaurantResource::collection($restaurant);

        return $this->responser($restaurant, $data, 'restaurants');

    }

    public function categoryInRestaurant( $id ) {
        $foods = Food::where('restaurant_id', $id )->orderBy('category_id', 'asc' )->get();

        $category_id = [];
        $categories = [];

        foreach ($foods as $food ) {

            if( !in_array( $food->category_id, $category_id ) ) {
                $category = Category::where('id', $food->category_id)->first();
                array_push( $category_id, $food->category_id);
                $categories[] = $category;
            }
        }


        $data = CategoryResource::collection( collect( $categories ));
        return $this->responser(collect($categories), $data, 'Categories');
    }
}
