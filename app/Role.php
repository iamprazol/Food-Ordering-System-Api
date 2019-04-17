<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'id',
        'role'
    ];

    public function user(){
        return $this->hasMany('App\User');
    }
}
