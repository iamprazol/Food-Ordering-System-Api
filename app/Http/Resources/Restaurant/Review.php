<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Resources\Json\JsonResource;

class Review extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

        return [
            'id' => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'restaurant_name' => $this->restaurant->restaurant_name,
            'name' => $this->name         ,
            'review' => $this->review,
            'user_id' => $this->user_id,
            'rating' => $this->rating,
            'created_at' => $this->created_at->format('M d, Y'),
            'reviewer_name' => $this->user ? $this->user->first_name . ' ' . $this->user->first_name : '',
            'reviewer_picture' => $this->user ? $this->user->picture : null,
        ];
    }
}
