<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderEvent extends Model
{
    protected $fillable = ['order_id','type','meta_json'];

    protected $casts = [
        'meta_json' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
