<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedOrder extends Model
{
    protected $fillable = [
        'id',
        'delivery_id',
        'order_id',
        'is_assigned',
        'is_cancelled'
    ];

    public function delivery(){
        return $this->belongsTo('App\Delivery');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }
}
