<?php

namespace App\Http\Controllers\Restaurant;

use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Resources\Restaurant\Category as CategoryResource;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;

class CategoryController extends Controller
{
    public function index($id){

        $category = Category::where('restaurant_id', $id)->orderBy('category_name', 'asc')->get();

        $data = CategoryResource::collection($category);

        return $this->responser($category, $data, 'Categories');

    }

    public function show()
    {
        $restaurant = Auth::user()->restaurant;
        if ($restaurant) {
            $category = Category::where('restaurant_id', $restaurant->id)->orderBy('category_name', 'asc')->paginate(15);
            return view('restaurant.category.show', ['categories' => $category, 'restaurants' => $restaurant]);
        } else {
            $restaurant = Restaurant::all();
            $category = Category::orderBy('restaurant_id', 'asc')->paginate(15);
            return view('restaurant.category.show', ['categories' => $category, 'restaurants' => $restaurant]);
        }
    }

    public function search(Request $r)
    {
        $id = $r->restaurant_id;

        $category = Category::orderBy('id', 'asc')->where('restaurant_id', $id)->paginate(15);

        $restaurant = Restaurant::all();

        return view('restaurant.category.show', ['categories' => $category, 'restaurants' => $restaurant]);

    }

    public function create($id){
        $restaurant = Restaurant::find($id);
        return view('restaurant.category.create')->with('restaurants', $restaurant);
    }


    public function storeCategory(Request $request){

        $this->Validate($request,[
            'category_name' => 'required|string|min:2',
        ]);

        Category::create([
            'restaurant_id' => $request->restaurant_id,
            'category_name' => $request->category_name,
        ]);

        Session::flash('success', 'Food Category details added successfully');
        return redirect()->route('category.show');
    }

    public function destroy($id){
        $category = Category::where('id', $id)->first();
        $category->delete();

        Session::flash('success', 'Category details deleted successfully');
        return redirect()->route('category.show');
    }

}
