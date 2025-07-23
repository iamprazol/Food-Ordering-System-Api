<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'id',
        'restaurant_id',
        'user_id',
        'name',
        'review',
        'rating'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
