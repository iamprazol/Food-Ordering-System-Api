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
            'food_id' => $this->food_id,
            'foods' => $this->food->food_name,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'address' => $this->address->address,
            'delivery_date' => Carbon::parse($this->delivery_date)->format('d/m/Y'),
            'delivery_time' =>   Carbon::parse($this->delivery_time)->format('g:i A'),
            'instruction' => $this->instruction,
            'paid' => $this->paid,
            'delivered' => $this->delivered
        ];
    }
}
