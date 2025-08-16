<?php

namespace App\Policies;

use App\User;
use App\Order;

class OrderPolicy
{
    public function actOn(User $user, Order $order)
    {
        return $user->role->role === 'manager'
            && $order->restaurant
            && (int)$order->restaurant->user_id === (int)$user->id;
    }

    public function carry(User $user, Order $order)
    {
        return $user->role->role === 'delivery';
    }
}
