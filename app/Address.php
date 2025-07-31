<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'address',
        'address_title',
        'address_details',
        'address_contact',
        'address_alternate_contact',
        'latitude',
        'longitude'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function order(){
        return $this->belongsTo('App\Order');
    }
}
