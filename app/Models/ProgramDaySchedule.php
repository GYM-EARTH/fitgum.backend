<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDaySchedule extends Model
{
    protected $casts = [
        'data' => 'array',
    ];

    public function day()
    {
        return $this->belongsTo(ProgramDay::class);
    }
}
