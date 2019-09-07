<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Notification;

class APNFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;
    public $succCount;
    public $failCount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($notification, $succCount, $failCount)
    {
        $this->notification = $notification;
        $this->succCount = $succCount;
        $this->failCount = $failCount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
