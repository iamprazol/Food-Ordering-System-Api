<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'cart_id',
        'address',
        'delivery_date',
        'delivery_time',
        'instruction',
        'total_price',
        'paid'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function cart(){
        return $this->belongsTo('App\Cart');
    }

}
