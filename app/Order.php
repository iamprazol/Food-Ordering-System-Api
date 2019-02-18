<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'cart_id',
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
