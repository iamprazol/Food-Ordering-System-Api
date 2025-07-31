<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'restaurant_id',
        'address_id',
        'delivery_date',
        'delivery_time',
        'instruction',
        'details',
        'total_price',
        'paid',
        'delivered'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }
}
