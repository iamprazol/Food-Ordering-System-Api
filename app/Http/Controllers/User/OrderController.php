<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Http\Resources\User\Order as OrderResource;


class OrderController extends Controller
{
    public function orderByUser($id){

        $order = Order::where('user_id', $id)->get();

        $data = OrderResource::collection($order);

        return $this->responser($order, $data, 'Orders');

    }
}
