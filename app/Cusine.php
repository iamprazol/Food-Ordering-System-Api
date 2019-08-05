<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cusine extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];

    public function restaurant(){
        return $this->hasMany('App\Restaurant');
    }
}
