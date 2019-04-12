<?php

namespace App\Http\Controllers\User;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Address as AddressResource;


class AddressController extends Controller
{
    public function addressByUser($id)
    {

        $address = Address::where('user_id', $id)->get();

        $data = AddressResource::collection($address);

        return $this->responser($address, $data, 'Address');

    }
}
