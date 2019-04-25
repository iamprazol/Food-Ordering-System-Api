<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin-panel', function () {
    return view('welcome');
});
Auth::routes();


Route::middleware(['auth','admin'])->prefix('admin')->group (function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('restaurant', ['as' => 'restaurant.show', 'uses' => 'Restaurant\RestaurantController@index']);
    Route::get('restaurant/profile', ['as' => 'restaurant.edit', 'uses' => 'Restaurant\RestaurantController@edit']);
    Route::post('restaurant/update/{id}', ['as' => 'restaurant.update', 'uses' => 'Restaurant\RestaurantController@update']);
    Route::post('restaurant/store', ['as' => 'restaurant.store', 'uses' => 'Restaurant\RestaurantController@storeRestaurant']);

    Route::get('food/category', ['as' => 'category.show', 'uses' => 'Restaurant\CategoryController@show']);
    Route::get('food/category/search', ['uses' => 'Restaurant\CategoryController@search', 'as' => 'category.search']);
    Route::get('food/category/create/{id}', ['as' => 'category.create', 'uses' => 'Restaurant\CategoryController@create']);
    Route::post('food/category/store', ['as' => 'category.store', 'uses' => 'Restaurant\CategoryController@storeCategory']);
    Route::delete('food/category/destroy/{id}', ['as' => 'category.destroy', 'uses' => 'Restaurant\CategoryController@destroy']);

    Route::get('food', ['as' => 'food.show', 'uses' => 'Restaurant\FoodController@show']);
    Route::get('food/search', ['uses' => 'Restaurant\FoodController@search', 'as' => 'food.search']);
    Route::get('food/create/{id}', ['as' => 'food.create', 'uses' => 'Restaurant\FoodController@create']);
    Route::post('food/store', ['as' => 'food.store', 'uses' => 'Restaurant\FoodController@storeFood']);
    Route::get('food/edit/{id}', ['as' => 'food.edit', 'uses' => 'Restaurant\FoodController@edit']);
    Route::post('food/update/{id}', ['as' => 'food.update', 'uses' => 'Restaurant\FoodController@updateFood']);
    Route::delete('food/destroy/{id}', ['as' => 'food.destroy', 'uses' => 'Restaurant\FoodController@destroy']);

    Route::get('restaurant/branches', ['as' => 'branches.show', 'uses' => 'Restaurant\BranchesController@show']);
    Route::get('restaurant/branches/search', ['uses' => 'Restaurant\BranchesController@search', 'as' => 'branches.search']);
    Route::get('restaurant/branches/create/{id}', ['as' => 'branches.create', 'uses' => 'Restaurant\BranchesController@create']);
    Route::post('restaurant/branches/store', ['as' => 'branches.store', 'uses' => 'Restaurant\BranchesController@storeBranch']);
    Route::get('restaurant/branches/edit/{id}', ['as' => 'branches.edit', 'uses' => 'Restaurant\BranchesController@edit']);
    Route::post('restaurant/branches/update/{id}', ['as' => 'branches.update', 'uses' => 'Restaurant\BranchesController@updateBranch']);
    Route::delete('restaurant/branches/destroy/{id}', ['as' => 'branches.destroy', 'uses' => 'Restaurant\BranchesController@destroy']);


    Route::get('restaurant/reviews', ['as' => 'reviews.show', 'uses' => 'Restaurant\ReviewController@show']);
    Route::get('restaurant/reviews/search', ['uses' => 'Restaurant\ReviewController@search', 'as' => 'reviews.search']);
    Route::delete('restaurant/reviews/destroy/{id}', ['as' => 'reviews.destroy', 'uses' => 'Restaurant\ReviewController@destroy']);

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

});
