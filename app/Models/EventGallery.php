<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventGallery extends Model
{
    protected $fillable = [
        'event_id',
        'path',
    ];

    public function event():BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
