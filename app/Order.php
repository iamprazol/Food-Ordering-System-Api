<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrderEvent;

class Order extends Model
{

    const STATUS_CREATED           = 'CREATED';
    const STATUS_SENT_TO_RESTAURANT= 'SENT_TO_RESTAURANT';
    const STATUS_ACCEPTED          = 'ACCEPTED';
    const STATUS_REJECTED          = 'REJECTED';
    const STATUS_READY             = 'READY';
    const STATUS_PICKED_UP         = 'PICKED_UP';
    const STATUS_ON_THE_WAY        = 'ON_THE_WAY';
    const STATUS_DELIVERED         = 'DELIVERED';
    const STATUS_CANCELLED         = 'CANCELLED';

    const PAY_NONE      = 'NONE';
    const PAY_AUTH      = 'AUTHORIZED';

    protected $fillable = [
        'id',
        'user_id',
        'restaurant_id',
        'address_id',
        'courier_id',
        'delivery_date',
        'delivery_time',
        'instruction',
        'details',
        'total_price',
        'status',
        'payment_status',
        'accepted_at',
        'ready_at',
        'picked_up_at',
        'delivered_at',
        'cancelled_at',
        'otp_code',
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function transitionTo($nextStatus, array $extra = [])
    {
        $valid = [
            [self::STATUS_SENT_TO_RESTAURANT, self::STATUS_ACCEPTED],
            [self::STATUS_SENT_TO_RESTAURANT, self::STATUS_REJECTED],
            [self::STATUS_ACCEPTED,          self::STATUS_READY],
            [self::STATUS_READY,             self::STATUS_PICKED_UP],
            [self::STATUS_PICKED_UP,         self::STATUS_ON_THE_WAY],
            [self::STATUS_ON_THE_WAY,        self::STATUS_DELIVERED],
        ];

        $ok = false;
        foreach ($valid as $pair) {
            if ($this->status === $pair[0] && $nextStatus === $pair[1]) { $ok = true; break; }
        }
        if (!$ok) {
            throw new \DomainException('Invalid transition from '.$this->status.' to '.$nextStatus);
        }

        $prev = $this->status;
        $this->fill(array_merge(['status' => $nextStatus], $extra));
        $this->save();

        OrderEvent::create([
            'order_id' => $this->id,
            'type' => 'status.'.$nextStatus,
            'meta_json' => [],
        ]);
    }
}
