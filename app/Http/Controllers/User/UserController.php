<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\User;

class UserController extends Controller
{
    public function index(){

        $user = User::OrderBy('id', 'asc')->get();

        $data = UserResource::collection($user);

        $num = count($user);

        if($num > 0){
            return $this->responser($data,200,"All user are listed");
        } else {
            return $this->responser($data,404,"No users found");
        }
    }

    public function userById($id){

        $user = User::where('id', $id)->get();

        $data = UserResource::collection($user);

        $num = count($user);

        if($num > 0){
            return $this->responser($data,200,"User with specific id is found");
        } else {
            return $this->responser($data,404,"User with specific id cannot be found");
        }
    }

}
