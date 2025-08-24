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
use App\Http\Controllers\AuthController;

Route::get('/admin-panel', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    if ($user->is_superAdmin()) {
        return redirect()->route('orders.index');
    }
    if ($user->is_manager()) {
        return redirect()->route('restaurant.orders.show');
    }
    if ($user->is_delivery()) {
        return redirect()->route('order.show');
    }

    // Fallback if user has no role
    return redirect()->route('login');
})->name('root');

Route::middleware('auth')->group(function () {

    Route::get('orders/view/{id}', ['as' => 'orders.view', 'uses' => 'Web\Orders\OrdersController@viewOrder']);
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('restaurant', ['as' => 'restaurant.show', 'uses' => 'Restaurant\RestaurantController@index']);
    Route::get('restaurant/profile/{id}', ['as' => 'restaurant.edit', 'uses' => 'Restaurant\RestaurantController@edit']);
    Route::post('restaurant/update/{id}', ['as' => 'restaurant.update', 'uses' => 'Restaurant\RestaurantController@update']);

});
Route::middleware('auth', 'role:admin|manager')->group( function () {
    Route::get('food/category', ['as' => 'category.show', 'uses' => 'Restaurant\CategoryController@show']);
    Route::get('food/category/search', ['uses' => 'Restaurant\CategoryController@search', 'as' => 'category.search']);
    Route::get('food/category/create', ['as' => 'category.create', 'uses' => 'Restaurant\CategoryController@create']);
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
});

Route::middleware('auth', 'role:admin')->group (function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('user/manager', ['as' => 'user.managers', 'uses' => 'UserController@manager']);
    Route::get('user/customer', ['as' => 'user.customers', 'uses' => 'UserController@customer']);
    Route::get('user/delivery', ['as' => 'user.delivery', 'uses' => 'Restaurant\DeliveryController@index']);
    Route::post('restaurant/store/{id}', ['as' => 'restaurant.store', 'uses' => 'Restaurant\RestaurantController@storeRestaurant']);

    Route::get('delivery/search', ['uses' => 'Restaurant\DeliveryController@search', 'as' => 'delivery.search']);
    Route::get('delivery/create/{id}', ['as' => 'delivery.create', 'uses' => 'Restaurant\DeliveryController@create']);
    Route::post('delivery/store', ['as' => 'delivery.store', 'uses' => 'Restaurant\DeliveryController@storeDelivery']);
    Route::get('delivery/edit/{id}', ['as' => 'delivery.edit', 'uses' => 'Restaurant\DeliveryController@edit']);
    Route::post('delivery/update/{id}', ['as' => 'delivery.update', 'uses' => 'Restaurant\DeliveryController@updateDelivery']);
    Route::delete('delivery/destroy/{id}', ['as' => 'delivery.destroy', 'uses' => 'Restaurant\DeliveryController@destroy']);

    Route::get('orders', ['as' => 'orders.index', 'uses' => 'Web\Orders\OrdersController@allOrders']);
});

Route::middleware('role:manager')->group(function () {
    Route::get('restaurant/orders', ['as' => 'restaurant.orders.show', 'uses' => 'Web\Orders\RestaurantOrderController@index']);
    Route::post('restaurant/orders/{order}/accept', ['as' => 'restaurant.order.accept', 'uses' => 'Web\Orders\RestaurantOrderController@accept'] );
    Route::post('restaurant/orders/{order}/reject', ['as' => 'restaurant.order.reject', 'uses' => 'Web\Orders\RestaurantOrderController@reject']);
    Route::post('restaurant/orders/{order}/ready', ['as' => 'restaurant.order.ready', 'uses' => 'Web\Orders\RestaurantOrderController@ready']);
});

Route::middleware('auth', 'role:delivery')->group(function () {
    Route::get('delivery/jobs', ['as' => 'order.show', 'uses' => 'Web\Orders\CourierJobController@index']);
    Route::post('delivery/jobs/{order}/pickup', ['as' => 'order.pickup', 'uses' => 'Web\Orders\CourierJobController@pickup']);
    Route::post('delivery/jobs/{order}/on-the-way', ['as' => 'order.onTheWay', 'uses' => 'Web\Orders\CourierJobController@onTheWay']);
    Route::post('delivery/jobs/{order}/deliver', ['as' => 'order.deliver', 'uses' => 'Web\Orders\CourierJobController@deliver']);
});
