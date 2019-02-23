<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Resources\Json\JsonResource;

class Restaurant extends JsonResource
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

        return[
            'id' => $this->id,
            'cusine_id' => $this->cusine_id,
            'cusine_name' => $this->cusine->name,
            'restaurant_name' => $this->restaurant_name,
            'description' => $this->description,
            'delivery_hours' => $this->delivery_hours,
            'minimum_order' => $this->minimum_order,
            'cover_pic' => $this->cover_pic,
            'picture' => $this->picture,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'vat' => $this->vat,
            'discount' => $this->discount,
            'additional_charges' => $this->additional_charge
        ];
    }
}
