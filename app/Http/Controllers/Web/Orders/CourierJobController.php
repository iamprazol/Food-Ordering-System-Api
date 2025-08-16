<?php

namespace App\Http\Controllers\Web\Orders;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class CourierJobController extends Controller
{
    public function index()
    {
        $orders =  Order::whereIn('status', [
            Order::STATUS_READY,
            Order::STATUS_PICKED_UP,
            Order::STATUS_ON_THE_WAY,
            Order::STATUS_DELIVERED
        ])
        ->orderBy('id','desc')
        ->paginate(15);

        return view('orders.index')->with('orders', $orders);
    }

    public function pickup(Order $order)
    {
        $this->authorize('carry', $order);
        $order->update(['status'=>Order::STATUS_PICKED_UP, 'picked_up_at'=>now(), 'courier_id' => auth()->user()->id]);
        return redirect()->route('order.show')->withStatus( array( 'type' => "success", "message" => __('Order Deliver Request Accepted Successfully.') ) );
    }

    public function onTheWay(Order $order)
    {
        $this->authorize('carry', $order);
        $order->update(['status'=>Order::STATUS_ON_THE_WAY]);

        return redirect()->route('order.show')->withStatus( array( 'type' => "success", "message" => __('Order Picked Up Successfully.') ) );
    }

    public function deliver(Order $order, Request $req)
    {
        $this->authorize('carry', $order);

        // $req->validate(['otp' => 'required|digits:6']);
        // if ($req->otp !== (string)$order->otp_code) {
        //     abort(422, 'Invalid OTP');
        // }
        $order->update(['status'=>Order::STATUS_DELIVERED, 'delivered_at'=>now()]);

        return redirect()->route('order.show')->withStatus( array( 'type' => "success", "message" => __('Order Delivered Successfully.') ) );
    }
}
