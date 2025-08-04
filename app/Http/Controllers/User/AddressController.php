<?php

namespace App\Http\Controllers\User;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Address as AddressResource;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addressByUser($id)
    {

        $address = Address::where('user_id', $id)->get();

        $data = AddressResource::collection($address);

        return $this->responser($address, $data, 'Address');

    }

    public function myAddress()
    {
        $address = Auth::user()->address;

        if(!$address){
            return response()->json(['status' => 404, 'message' => 'Address not found'],404);
        }

        $data = AddressResource::collection($address);
        return $this->responser($address, $data, 'Address');

    }

    public function addAddress(Request $r){

        $user = Auth::user();

        $address = Address::create([
            'user_id' => $user->id,
            'address' => $r->address
        ]);

        $data = new AddressResource($address);

        return response()->json(['data' => $data,'status' => 200,'message' => 'Address added successfully'],200);

    }

    public function removeAddress($id){

        $address = Address::where('user_id', Auth::id())->where('id', $id)->first();

        if(!$address){
            abort(404);
        }

        $address->delete();

        return response()->json(['status' => 200,'message' => 'Address deleted successfully'],200);

    }

     public function update(Request $r){
         $id = $r->id;
        $address = Address::find($id);

        if (!$address) {
            return response()->json([
                'data' => null,
                'status' => 404,
                'message' => 'Address not found',
            ], 404);
        }

        $address->update([
            'address' => $r->address,
            'address_title' => $r->address_title,
            'address_contact' => $r->address_contact,
            'address_alternate_contact' => $r->address_alternate_contact,
            'address_details' => $r->address_details,
        ]);

        $data = new AddressResource($address);

        return response()->json(['data' => $data,'status' => 200,'message' => 'Address updated successfully'],200);
    }

}
