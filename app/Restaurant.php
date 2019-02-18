<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'id',
        'restaurant_name',
        'address',
        'description',
        'delivery_hours',
        'minimum_order',
        'cover_pic',
        'picture'
    ];

    public function food(){
        return $this->hasMany('App\Food');
    }

    public function branch(){
        return $this->hasMany('App\Branch');
    }

    public function review(){
        return $this->hasMany('App\Review');
    }

    public function cart(){
        return $this->hasMany('App\Cart');
    }

    public function special(){
        return $this->hasMany('App\Special');
    }

    public function favourites(){
        return $this->hasMany('App\Favourites');
    }

}
