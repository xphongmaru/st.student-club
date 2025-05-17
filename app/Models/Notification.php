<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'content',
        'type',
        'icon',
        'url',
        'user_id',
        'club_id',
        'sender_id',
        'is_read',
        'read_at',
        'status'
    ];

    public function club():BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
