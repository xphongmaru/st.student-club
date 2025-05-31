<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'event_date',
        'club_id',
        'thumbnail',
    ];

    public function club() : BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function galleries():HasMany
    {
        return $this->hasMany(EventGallery::class, 'event_id');
    }
}
