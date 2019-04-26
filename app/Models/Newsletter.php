<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 4/24/19
 * Time: 10:06 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Newsletter extends Model
{
    use Notifiable;

    protected $table = 'newsletter';

    protected $fillable = [
        'email',
        'token',
        'status',
    ];

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivated($query)
    {
        return $query->where('status', $this::STATUS_ACTIVE);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWait($query)
    {
        return $query->where('status', $this::STATUS_WAIT);
    }
}
