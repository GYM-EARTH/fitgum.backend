<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubType extends Model
{
    public function clubs()
    {
        return $this->hasMany(Club::class);
    }
}
