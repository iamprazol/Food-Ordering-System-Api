<?php

namespace App\Http\Controllers\Web\Orders;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusUpdated;

class RestaurantOrderController extends Controller
{
    public function index()
    {
        $ownerId = Auth::user()->id ?? null;

        $orders =  Order::whereHas('restaurant', function ($q) use ($ownerId) {
            $q->where('user_id', $ownerId);
        })
        ->whereIn('status', [
            Order::STATUS_SENT_TO_RESTAURANT,
            Order::STATUS_ACCEPTED,
            Order::STATUS_READY
        ])
        ->orderBy('id','desc')
        ->paginate(15);

        return view('orders.index')->with('orders', $orders);
    }

    public function accept(Order $order)
    {
        $this->authorize('actOn', $order);
        $order->update(['status'=>Order::STATUS_ACCEPTED, 'accepted_at'=>now()]);
        $order->user->notify(new OrderStatusUpdated($order, __('Your Order has been Acknowledged by the Restaurant') ));
        return redirect()->route('orders.index')->withStatus( array( 'type' => "success", "message" => __('Order Approved Successfully.') ) )->with('orders', Order::where('restaurant_id', $order->restaurant_id)->paginate(15));
    }

    public function reject(Order $order)
    {
        $this->authorize('actOn', $order);
        $order->update(['status'=>Order::STATUS_REJECTED]);
        $order->user->notify(new OrderStatusUpdated($order, __('Your Order has been Rejected by the Restaurant') ));
        return redirect()->route('orders.index')->withStatus( array( 'type' => "success", "message" => __('Order cancelled successfuly.') ) )->with('orders', Order::where('restaurant_id', $order->restaurant_id)->paginate(15));
    }

    public function ready(Order $order)
    {
        $this->authorize('actOn', $order);
        $order->update(['status'=>Order::STATUS_READY, 'ready_at'=>now()]);
        $order->user->notify(new OrderStatusUpdated($order, __('Your Order is Ready for Delivery') ));
        return redirect()->route('orders.index')->withStatus( array( 'type' => "success", "message" => __('Order Ready for delivery.') ) )->with('orders', Order::where('restaurant_id', $order->restaurant_id)->paginate(15));
    }
}
