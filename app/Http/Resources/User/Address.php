<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'full_name' => ucfirst( $this->user->first_name ).' '.ucfirst($this->user->last_name),
            'address' => $this->address,
            'address_title' => $this->address_title,
            'address_details' => $this->address_details,
            'address_contact' => $this->address_contact,
            'address_alternate_contact' => $this->address_alternate_contact,
        ];
    }
}
