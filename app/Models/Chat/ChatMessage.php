<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 3/19/19
 * Time: 6:30 PM
 */

namespace App\Models\Chat;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatMessage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'message',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
