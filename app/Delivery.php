<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'id',
        'restaurant_id',
        'user_id',
        'is_available'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function assigned_order(){
        return $this->hasMany('App\AssignedOrder');
    }
}
