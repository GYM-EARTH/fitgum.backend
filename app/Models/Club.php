<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Club extends Model
{
    protected $dispatchesEvents = [
        'saving' => \App\Events\ClubSaving::class,
    ];

    public function type()
    {
        return $this->belongsTo(ClubType::class, 'club_type_id', 'id');
    }

    public function metros()
    {
        return $this->belongsToMany(Metro::class, 'club_metro', 'club_id', 'metro_id');
    }

    public function microServices()
    {
        return $this->belongsToMany(MicroService::class, 'club_service', 'club_id', 'service_id');
    }

    public function clubPhotos()
    {
        return $this->hasMany(ClubPhoto::class);
    }

    public function clubServices()
    {
        return $this->hasMany(ClubService::class);
    }

    public function clubTimes()
    {
        return $this->hasMany(ClubTime::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'club_level');
    }

    public function trainers()
    {
        return $this->hasMany(Trainer::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'club_user');
    }
}
