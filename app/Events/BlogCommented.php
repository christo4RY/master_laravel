<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BlogCommented
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $blog;
    public $comment;
    /**
     * Create a new event instance.
     */
    public function __construct($blog,$comment)
    {
        $this->blog = $blog;
        $this->comment = $comment;
    }

}
