<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'id',
        'restaurant_id',
        'category_id',
        'food_name',
        'picture',
        'price'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function favourite(){
        return $this->hasMany('App\Favourites');
    }
}
