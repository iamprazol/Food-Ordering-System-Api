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
        $order = Auth::user()->order;

        $data = OrderResource::collection($order);

        return $this->responser($data, $data, 'Orders');

    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'restaurant_id' => $request->restaurant_id,
            'address_id' => $request->address_id,
            'delivery_date' => Carbon::now()->format('Y-m-d'),
            'delivery_time' => Carbon::now()->addHour()->format('H:i:s'),
            'instruction' => $request->instruction,
            'total_price' => $request->total_price,
            'details' => $request->details,
        ]);

        $data = new OrderResource($order);
        if( $data ) {
           return response()->json(['success'=>$data], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
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
