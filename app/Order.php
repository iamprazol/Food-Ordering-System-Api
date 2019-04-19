<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'food_id',
        'quantity',
        'address',
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

}
