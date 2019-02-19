<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 2/19/19
 * Time: 10:16 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClubTime extends Model
{
    protected $fillable = [
        'start',
        'finish',
        'all_day',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id', 'id');
    }
}
