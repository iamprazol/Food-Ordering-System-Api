<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'category_name',
        'category_pic'
    ];

    public function food(){
        return $this->hasMany('App\Food');
    }
}
