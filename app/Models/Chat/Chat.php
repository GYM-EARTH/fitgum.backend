<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 3/19/19
 * Time: 6:30 PM
 */

namespace App\Models\Chat;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_users');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
