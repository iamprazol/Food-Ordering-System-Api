<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'restaurant_name',
        'address',
        'description',
        'delivery_from',
        'delivery_to',
        'minimum_order',
        'cover_pic',
        'picture',
        'latitude',
        'longitude',
        'discount',
        'additional_charge',
        'vat'
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function food(){
        return $this->hasMany('App\Food');
    }

    public function branch(){
        return $this->hasMany('App\Branch');
    }

    public function review(){
        return $this->hasMany('App\Review');
    }

    public function manager(){
        return $this->hasMany('App\Manager');
    }

    public function favourite(){
        return $this->hasMany('App\Favourites');
    }

}
