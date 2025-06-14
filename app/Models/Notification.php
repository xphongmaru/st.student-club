<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function getSender()
    {
        return User::query()->where('id', $this->sender_id)->first();
    }

    public function notificationUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_notification')
            ->withPivot('notification_id', 'user_id', 'is_read', 'read_at')
            ->withTimestamps();
    }

    public function attachments():HasMany
    {
        return $this->hasMany(Attachment::class, 'notification_id');
    }
}
