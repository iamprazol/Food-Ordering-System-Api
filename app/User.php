<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','first_name', 'last_name', 'email', 'password', 'phone', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function order(){
        return $this->hasMany('App\Order');
    }

    public function cart(){
        return $this->hasMany('App\Cart');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function favourite(){
        return $this->hasMany('App\Favourites');
    }

    public function address(){
        return $this->hasMany('App\Address');
    }

    public function restaurant(){
        return $this->hasOne('App\Restaurant');
    }

    public function is_superAdmin($id){
        $user = User::where('id' , $id)->first();
        if($user->role_id == 1 ){
            return true;
        } else {
            return false;
        }
    }

    public function is_manager($id){
        $user = User::where('id' , $id)->first();
        if($user->role_id == 2 ){
            return true;
        } else {
            return false;
        }
    }
}
