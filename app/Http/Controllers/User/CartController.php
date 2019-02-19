<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Cart as CartResource;
use App\Cart;

class CartController extends Controller
{
    public function cartByUser($id){

        $cart = Cart::where('user_id', $id)->get();

        $data = CartResource::collection($cart);

        $num = count($data);

        if($num > 0){
            return $this->responser($data,200,"Cart with specific user_id is found");
        } else {
            return $this->responser($data,404,"Cart with specific user_id cannot be found");
        }
    }
}
