<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $dispatchesEvents = [
        'saving' => \App\Events\TrainerSaving::class,
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id', 'id');
    }
}
