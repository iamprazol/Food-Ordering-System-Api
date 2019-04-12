<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Cart as CartResource;
use App\Cart;

class CartController extends Controller
{
    public function cartByUser($id)
    {

        $cart = Cart::where('user_id', $id)->get();

        $data = CartResource::collection($cart);

        return $this->responser($cart, $data, 'Cart');

    }
}
