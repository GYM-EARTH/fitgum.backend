<?php

namespace App\Models;

use App\Models\Chat\Chat;
use App\Models\Chat\ChatMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_users');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
