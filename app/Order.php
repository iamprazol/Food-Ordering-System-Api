<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'food_id',
        'address_id',
        'quantity',
        'delivery_date',
        'delivery_time',
        'instruction',
        'total_price',
        'paid',
        'delivered'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function food(){
        return $this->belongsTo('App\Food');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }
}
