<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierLocation extends Model
{
    protected $fillable = ['courier_id','lat','lng','heading'];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'heading' => 'float',
    ];
}
