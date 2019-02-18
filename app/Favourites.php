<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'restaurant_id',
        'food_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function food(){
        return $this->belongsTo('App\Food');
    }
}
