<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    public function type()
    {
        return $this->belongsTo(ClubType::class, 'club_type_id', 'id');
    }
}
