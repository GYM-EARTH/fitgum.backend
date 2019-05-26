<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 5/26/19
 * Time: 6:15 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ClubService extends Model
{
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
