<?php

namespace App\Http\Controllers\Web\Orders;

use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController  extends Controller
{

    public function allOrders(Order $model) {
        $user = Auth::user();
        $orders = 'admin' === $user->role->role ? $model->orderBy('created_at', 'desc') : $user->restaurant->order()->orderBy('created_at', 'desc');
        return view('orders.index', ['orders' => $orders->paginate(15)]);
    }

    public function viewOrder( $id ) {
        $order = Order::where('id', $id)->first();
        return view('orders.view')->with('order', $order);
    }
}
