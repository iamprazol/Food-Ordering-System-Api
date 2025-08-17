<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Order;
use Carbon\Carbon;

class OrderStatusUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->data = [
            'order_id' => $this->order->id,
            'status' => $this->order->status,
            'message' => $this->order->message,
            'is_read' => false,
            "created_at" => Carbon::now()
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.' . $this->order->user_id);
    }

    /**
     * The data that should be broadcasted.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return$this->data;
    }

    public function broadcastType()
    {
        return 'OrderStatusUpdatedEvent';
    }
}
