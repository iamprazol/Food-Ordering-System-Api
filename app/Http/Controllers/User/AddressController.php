<?php

namespace App\Http\Controllers\User;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Address as AddressResource;


class AddressController extends Controller
{
    public function addressByUser($id){

        $address = Address::where('user_id', $id)->get();

        $data = AddressResource::collection($address);

        $num = count($data);

        if($num > 0){
            return $this->responser($data,200,"Address with specific user_id is found");
        } else {
            return $this->responser($data,404,"Address with specific user_id cannot be found");
        }
    }
}
