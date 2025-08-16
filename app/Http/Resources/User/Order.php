<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Order extends JsonResource
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
            'user_name' => $this->user->first_name.' '.$this->user->last_name,
            'restaurant_id' => $this->restaurant_id,
            'restaurant_name' => $this->restaurant->restaurant_name,
            'restaurant_image' => $this->restaurant->picture,
            'restaurant_address' => $this->restaurant->address,
            'total_price' => $this->total_price,
            'address' => $this->address->address,
            'delivery_date' => Carbon::parse($this->delivery_date)->format('d/m/Y'),
            'delivery_time' =>   Carbon::parse($this->delivery_time)->format('g:i A'),
            'instruction' => $this->instruction,
            'paid' => $this->paid,
            'delivered' => $this->delivered,
            'details' => $this->details,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ];
    }
}
