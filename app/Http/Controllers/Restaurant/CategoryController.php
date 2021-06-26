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
use Image;

class CategoryController extends Controller
{
    public function index(){

        $category = Category::orderBy('category_name', 'asc')->get();

        $data = CategoryResource::collection($category);

        return $this->responser($category, $data, 'Categories');

    }

    public function show()
    {
        $category = Category::orderBy('category_name', 'asc')->paginate(15);
        return view('restaurant.category.show', ['categories' => $category]);
        
    }

    public function search()
    {
        $category = Category::orderBy('id', 'asc')->paginate(15);

        return view('restaurant.category.show', ['categories' => $category]);

    }

    public function create(){
        return view('restaurant.category.create');
    }


    public function storeCategory(Request $request){

        $this->Validate($request,[
            'category_name' => 'required|string|min:2',
            'picture' =>'required|max:15360',
        ]);

        $picfilename = time() . '.' . $request->file('picture')->getClientOriginalExtension();
        $picpath = public_path('/images/category/' . $picfilename);
        Image::make($request->file('picture'))->save($picpath);

        Category::create([
            'category_name' => $request->category_name,
            'category_pic' => $picfilename,
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
