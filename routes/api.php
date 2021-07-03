<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user' , function (Request $request) {
    return $request->user();
});

Route::post('login', 'User\UserController@login');
Route::post('register', 'User\UserController@register');


//Routes for the apis that only customer is capable of accessing
Route::group(['middleware' => ['auth:api' , 'customer']], function () {

    Route::get('userlist','User\UserController@index'); //list all users registered
    Route::get('orderbyuser/{id}', 'User\OrderController@orderByUser');     //List the order issued by specific user


    //User
    Route::post('logout', 'User\UserController@logout');
    Route::get('myprofile','User\UserController@myProfile');     //list specific user detils
    Route::put('editprofile','User\UserController@update');     //list specific user detils
    Route::put('changepassword','User\UserController@changePassword');     //list specific user detils


    //Address
    Route::get('addressbyuser/', 'User\AddressController@addressByUser');     //List the address saved by specific user for delivery
    Route::get('myaddress/', 'User\AddressController@myAddress');     //List the address saved by specific user for delivery
    Route::post('addaddress/', 'User\AddressController@addAddress');     //List the address saved by specific user for delivery
    Route::delete('removeaddress/{id}', 'User\AddressController@removeAddress');     //List the address saved by specific user for delivery


    //Favourites
    Route::get('myfavouriterestaurant', 'User\FavouritesController@myFavouriteRestaurant');     //List the favourite restaurant and food item by specific user
    Route::get('myfavouritefood', 'User\FavouritesController@myFavouriteFood');     //List the favourite restaurant and food item by specific user
    Route::post('favouritefood/{id}', 'User\FavouritesController@food');     //List the favourite restaurant and food item by specific user
    Route::post('favouriterestaurant/{id}', 'User\FavouritesController@restaurant');     //List the favourite restaurant and food item by specific user
    Route::delete('deletefavouritefood/{id}', 'User\FavouritesController@deleteFavouriteFood');     //Delete a specific item issued by specific user from the cart
    Route::delete('deletefavouriterestaurant/{id}', 'User\FavouritesController@deleteFavouriteRestaurant');     //Delete a specific item issued by specific user from the cart


    //Carts
    Route::get('mycart', 'User\CartController@myCart');     //List the cart issued by specific user
    Route::post('addtocart/{id}', 'User\CartController@addToCart');     //Add item to the cart issued by specific user
    Route::post('removefromcart/{id}', 'User\CartController@decreaseAQuantity');     //Remove a quantity of a specific item issued by specific user from the cart
    Route::delete('deletefromcart/{id}', 'User\CartController@deleteAnItem');     //Delete a specific item issued by specific user from the cart


    //Orders
    Route::get('myorder', 'User\OrderController@myOrder');     //List the order issued by specific user
    Route::post('order', 'User\OrderController@create');     //Add item to the Order issued by specific user
    Route::delete('cancelorder/{id}', 'User\OrderController@deleteOrder');     //Cancel Specific Order issued by specific user

});


//Routes only restaurant user can access
Route::group(['middleware' => ['auth:api' , 'manager']], function () {
    Route::post('createuser', 'Restaurant\ManagerController@createUser');
    Route::get('listmanagers', 'Restaurant\ManagerController@listManagers');

});

Route::get('restaurant/{id}', 'Restaurant\RestaurantController@viewRestaurant');  //List the details of a specific branch
Route::get('branchbyid/{id}', 'Restaurant\BranchesController@branchById');  //List the details of a specific branch
Route::get('branchofrestaurant/{id}','Restaurant\BranchesController@branchOfRestaurant'); //List the branches of a specific restaurant
Route::get('reviewofrestaurant/{id}','Restaurant\ReviewController@reviewOfRestaurant');  //List the reviews of a specific restaurant
Route::get('categoryinrestaurant/{id}','Restaurant\RestaurantController@categoryInRestaurant');  //List the foods available in a specific restaurant
Route::get('foodofrestaurant/{id}','Restaurant\FoodController@foodOfRestaurant');  //List the foods available in a specific restaurant
Route::get('foodbycategory/{id}','Restaurant\FoodController@foodByCategory');  //List the foods available in a specific category
Route::get('cusine','Restaurant\CusineController@index');  //List all the cusines

Route::get('restaurants', 'Restaurant\RestaurantController@searchRestaurant');  //List all restaurant with letters supplied in name attribute
Route::get('foods', 'Restaurant\FoodController@AllFoods');  //List all restaurant with letters supplied in name attribute

/*Route::get('/admin', function(){
    return response(['message' =>'Hello Admin', 'status' => 200]) ;
})->middleware('auth:api','admin');

Route::get('/delivery', function(){
    return response(['message' =>'Hello Delivery Boy', 'status' => 200]) ;
})->middleware('auth:api','delivery');

Route::get('/customer', function(){
    return response(['message' =>'Hello Customer', 'status' => 200]) ;
})->middleware('auth:api','customer');

Route::get('/manager', function(){
    return response(['message' =>'Hello Restaurant Manager', 'status' => 200]) ;
})->middleware('auth:api','manager');
*/
