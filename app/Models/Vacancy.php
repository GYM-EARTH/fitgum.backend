<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Vacancy extends Model
{

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id', 'id');
    }

    public function metro()
    {
        return $this->belongsTo(Metro::class, 'metro_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
