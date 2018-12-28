<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flaer extends Model
{
    protected $table = 'flaers';

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id', 'id');
    }
}
