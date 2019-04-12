<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Resources\Restaurant\Category as CategoryResource;

class CategoryController extends Controller
{
    public function index($id){

        $category = Category::where('restaurant_id', $id)->orderBy('category_name', 'asc')->get();

        $data = CategoryResource::collection($category);

        return $this->responser($category, $data, 'Categories');

    }
}
