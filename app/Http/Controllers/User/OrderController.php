<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Http\Resources\User\Order as OrderResource;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('customer');
    }

    public function orderByUser($id){

        $order = Order::where('user_id', $id)->get();

        $data = OrderResource::collection($order);

        return $this->responser($order, $data, 'Orders');

    }

    public function myOrder(){

        $data = OrderResource::collection(Auth::user()->order);

        return $this->responser($data, $data, 'Orders');

    }
}
