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

        $num = count($order);

        if($num > 0){
            return $this->responser($data,200,"Order with specific user_id is found");
        } else {
            return $this->responser($data,404,"Order with specific user_id cannot be found");
        }
    }
}
