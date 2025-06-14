<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $fillable = [
        'name',
        'path',
        'notification_id',
    ];

    public function notification():BelongsTo
    {
        return $this->belongsTo(Notification::class, 'notification_id');
    }
}
