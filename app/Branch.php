<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'id',
        'restaurant_id',
        'branch_name',
        'address',
        'picture'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }
}
