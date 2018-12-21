<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $casts = [
        'status' => 'bool',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
