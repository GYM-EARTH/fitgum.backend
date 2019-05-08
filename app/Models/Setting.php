<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 5/7/19
 * Time: 8:39 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'title',
        'description',
        'keywords',
    ];
}
