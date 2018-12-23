<?php

namespace App\Events;

use App\Models\Club;
use Illuminate\Queue\SerializesModels;

class ClubSaving
{
    use SerializesModels;

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
