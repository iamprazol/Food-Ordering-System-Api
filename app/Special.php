<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    protected $fillable = [
        'id',
        'restaurant_id',
        'food_id'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function food(){
        return $this->belongsTo('App\Food');
    }
}
