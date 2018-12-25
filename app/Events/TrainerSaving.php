<?php

namespace App\Events;

use App\Models\Trainer;
use Illuminate\Queue\SerializesModels;

class TrainerSaving
{
    use SerializesModels;

    public $trainer;

    /**
     * Create a new event instance.
     *
     * @param Trainer $trainer
     */
    public function __construct(Trainer $trainer)
    {
        $this->trainer = $trainer;
    }
}
