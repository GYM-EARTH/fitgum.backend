<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MicroService extends Model
{
    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'club_service');
    }
}
