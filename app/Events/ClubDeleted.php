<?php

namespace App\Events;

use App\Models\Club;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ClubDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $club;

    /**
     * Create a new event instance.
     *
     * @param Club $club
     */
    public function __construct(Club $club)
    {
        $this->club = $club;
    }
}
