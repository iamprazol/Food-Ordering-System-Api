<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Cart as CartResource;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use App\Food;
use Session;
class CartController extends Controller
{
    public function myCart(){

        $data = CartResource::collection(Auth::user()->cart);

        return $this->responser($data, $data, 'Carts');

    }

    public function addToCart($id)
    {
        $food = Food::find($id);
        if ( $food == null ) {
            return abort( 404 );
        }
        $user = Auth::user();
        //CHeck whether product exist if yes increase quantity
        $entry = Cart::where('user_id', $user->id)->get();
        if ($entry != null) {
            $f = Cart::where(['user_id' => $user->id,'food_id' => $id])->first();
            if(!$f){
                Cart::create([
                    "food_id" => $id,
                    "quantity" => 1,
                    "price" => $food->price,
                    "user_id" => $user->id,
                    "restaurant_id" => $food->restaurant->id
                ]);
            } else {
                $f->quantity = $f->quantity + 1;
                $f->price = $food->price * $f->quantity;
                $f->save();
            }
        } else {
            Cart::create([
                "food_id" => $id,
                "quantity" => 1,
                "price" => $food->price,
                "user_id" => $user->id,
                "restaurant_id" => $food->restaurant->id
            ]);
        }
        $data = collect( Cart::where( [ 'user_id' => $user->id, 'food_id' => $id ] )->get());
        return response(['data' => $data, 'status' => 200, 'message' => 'Food Item Added to cart successfully'], 200);
    }

    public function decreaseAQuantity($id){
        $food = Food::find($id);
        if ( $food == null ) {
            return abort( 404 );
        }
        $user = Auth::user();
        //CHeck whether product exist if yes increase quantity
        $entry = Cart::where('user_id', $user->id)->get();
        if ($entry != null) {
            $f = Cart::where(['user_id' => $user->id, 'food_id' => $id])->first();
            if ($f) {
                if($f->quantity > 1){
                    $f->quantity = $f->quantity - 1;
                    $f->price = $food->price * $f->quantity;
                    $f->save();
                    return response()->json(['status' => 200, 'message' => 'food item quantity decreased from the cart'], 200);
                } else {
                    $f->delete();
                    return response()->json(['status' => 404, 'message' => 'No food item in the cart'], 404);
                }
            }else{
                return response()->json(['status' => 404, 'message' => 'User has no food in the cart'], 404);
            }
        } else {
            return response()->json(['status' => 404, 'message' => 'User has no cart'], 404);
        }
    }


        public function deleteAnItem($id){
            $food = Food::find($id);
            if ( $food == null ) {
                return abort( 404 );
            }
            $user = Auth::user();
            //CHeck whether product exist if yes increase quantity
            $entry = Cart::where('user_id', $user->id)->get();
            if ($entry != null) {
                $f = Cart::where(['user_id' => $user->id, 'food_id' => $id])->first();
                $data = collect( Cart::where( [ 'user_id' => $user->id, 'food_id' => $id ] )->get());
                if ($f){
                    $f->delete();
                    return response(['data' => $data, 'status' => 200, 'message' => 'Food Item deleted from the cart successfully'], 200);
                } else{
                    return response(['data' => $data, 'status' => 404, 'message' => 'User has no food in the cart'], 404);

                }
            } else {
                return response(['data' => $entry, 'status' => 404, 'message' => 'User has no cart'], 404);
            }
    }

}
