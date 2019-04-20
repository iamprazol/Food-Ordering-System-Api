<?php

namespace App\Http\Controllers\User;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Http\Resources\User\Order as OrderResource;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;


class OrderController extends Controller
{
    public function orderByUser($id)
    {

        $order = Order::where('user_id', $id)->get();

        $data = OrderResource::collection($order);

        return $this->responser($order, $data, 'Orders');

    }

    public function myOrder()
    {
        $order = Auth::user()->order->where('delivered', 0);

        $data = OrderResource::collection($order);

        return $this->responser($data, $data, 'Orders');

    }

    public function create()
    {
        $cart = Auth::user()->cart;

        $r = request();

        $num = count($cart);
        if ($num == 0) {
            return $this->responser($cart, $cart, 'Cart');
        } else {
            foreach ($cart as $c) {
                $order = Order::create([
                    'user_id' => $c->user_id,
                    'food_id' => $c->food_id,
                    'quantity' => $c->quantity,
                    'address_id' => $r->address_id,
                    'delivery_date' => $r->delivery_date,
                    'delivery_time' => Carbon::parse($r->delivery_time)->format('H:i:s'),
                    'instruction' => $r->instruction,
                    'total_price' => $c->price,
                ]);

                $c->delete();
                $detail[] = $order;
            }

        $data = OrderResource::collection(collect($detail));
        return $this->responser(collect($detail), $data, 'Food Ordered and');
        }
    }

    public function deleteOrder($id)
    {
        $now = Carbon::now();
        $order = Order::where('id', $id)->get();

        $num = count($order);

        if ($num == 0) {
            return $this->responser($order, $order, 'Order');
        } else {
            foreach ($order as $o) {
                $order_time = $o->created_at;
                $cancel_time = Carbon::parse($order_time)->addMinutes(10);

                if ($now > $cancel_time) {
                    return response()->json(['status' => 406, 'message' => 'You cannot cancel the order after 10 minutes of order time'], 406);
                } else {
                    $o->delete();
                    return response()->json(['status' => 200, 'message' => 'Order has been cancelled'], 200);
                }
            }
        }
    }

}
