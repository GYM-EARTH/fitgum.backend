<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 4/24/19
 * Time: 10:06 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $primaryKey = 'email';
    public $incrementing = false;
    const UPDATED_AT = null;

    protected $fillable = [
        'email', 'token'
    ];
}
