<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $dispatchesEvents = [
        'saving' => \App\Events\ClubSaving::class,
    ];

    public function type()
    {
        return $this->belongsTo(ClubType::class, 'club_type_id', 'id');
    }
}
