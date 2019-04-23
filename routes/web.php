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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('restaurant', ['as' => 'restaurant.show', 'uses' => 'Restaurant\RestaurantController@index']);
    Route::get('restaurant/profile', ['as' => 'restaurant.edit', 'uses' => 'Restaurant\RestaurantController@edit']);
    Route::post('restaurant/update/{id}', ['as' => 'restaurant.update', 'uses' => 'Restaurant\RestaurantController@update']);
    Route::post('restaurant/store', ['as' => 'restaurant.store', 'uses' => 'Restaurant\RestaurantController@storeRestaurant']);


});

