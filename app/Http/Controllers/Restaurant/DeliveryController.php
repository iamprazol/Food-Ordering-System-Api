<?php

namespace App\Http\Controllers\Restaurant;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Delivery;
use App\Restaurant;
use App\User;
use Session;

class DeliveryController extends Controller
{
    public function index()
    {
        $restaurant = Auth::user()->restaurant;
        if ($restaurant) {
            $delivery = Delivery::where('restaurant_id', $restaurant->id)->orderBy('restaurant_id', 'asc')->paginate(15);
            return view('restaurant.delivery.show', ['deliveries' => $delivery, 'restaurants' => $restaurant]);
        } else {
            $restaurant = Restaurant::all();
            $delivery = Delivery::orderBy('restaurant_id', 'asc')->paginate(15);
            return view('restaurant.delivery.show', ['deliveries' => $delivery, 'restaurants' => $restaurant]);
        }
    }

    public function search(Request $r)
    {
        $id = $r->restaurant_id;

        $delivery = Delivery::orderBy('id', 'asc')->where('restaurant_id', $id)->paginate(15);

        $restaurant = Restaurant::all();

        return view('restaurant.delivery.show')->with('restaurants', $restaurant)->with('deliveries', $delivery);

    }

    public function create($id){
        $restaurant = Restaurant::find($id);
        $role = Role::where('id', 3)->first();
        return view('restaurant.delivery.create')->with('restaurants', $restaurant)->with('roles', $role);
    }

    public function storeDelivery(Request $request){

        $this->Validate($request,[
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' =>'required|email',
        ]);

        $user = User::create([
            'role_id' => $request->role_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'c_password' => $request->password_confirmation,
            'phone' => $request->phone,
        ]);

        Delivery::create([
            'restaurant_id' => $request->restaurant_id,
            'user_id' => $user->id
        ]);
        return redirect()->route('user.delivery')->withStatus(__('Delivery Boy details added successfully'));
    }

    public function edit($id){
        $delivery = Delivery::where('user_id', $id)->first();
        return view('restaurant.delivery.edit')->with('deliveries', $delivery);
    }

    public function updateDelivery(Request $request, $id){

        $this->Validate($request,[
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' =>'required|email',
        ]);

        $user = User::find($id);
        $user->role_id = $request->role_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        Session::flash('success', 'Food details updated successfully');
        return redirect()->route('user.delivery');
    }
}
