<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDay extends Model
{
    public function schedules()
    {
        return $this->belongsToMany(ProgramDaySchedule::class, 'program_day_schedule_relation');
    }
}
