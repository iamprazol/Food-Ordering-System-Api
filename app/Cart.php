<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'food_id',
        'restaurant_id',
        'price'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function food(){
        return $this->belongsTo('App\Food');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
}
