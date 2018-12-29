<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'club_service');
    }
}
