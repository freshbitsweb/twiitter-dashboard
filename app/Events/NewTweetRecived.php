<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewTweetRecived implements ShouldBroadcast, ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tweet;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-tweet-channel');
    }
}
