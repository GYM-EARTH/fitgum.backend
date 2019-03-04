<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'club_level');
    }
}
