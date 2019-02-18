<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'id',
        'restaurant_id',
        'name',
        'review'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
}
