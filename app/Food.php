<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
      'id',
      'restaurant_id',
      'food_name',
      'picture',
        'price'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
}
