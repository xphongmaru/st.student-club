<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
