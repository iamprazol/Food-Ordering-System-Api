<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'address'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }
}
