<?php

namespace App\Http\Resources\Restaurant;

use Carbon\Carbon;
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
            'user_id' => $this->user_id,
            'restaurant_name' => $this->restaurant_name,
            'description' => $this->description,
            'delivery_hours' => Carbon::parse($this->delivery_from)->format('H:i') .' To '.Carbon::parse($this->delivery_to)->format('H:i'),
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
