<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'restaurant_id',
        'category_name'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function food(){
        return $this->hasMany('App\Food');
    }
}
