<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDaySchedule extends Model
{
    protected $casts = [
        'data' => 'array',
    ];

    public function days()
    {
        return $this->belongsToMany(ProgramDay::class, 'program_day_schedule_relation');
    }
}
