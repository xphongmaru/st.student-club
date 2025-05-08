<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
    protected $fillable = ['name', 'url', 'icon_id', 'club_id'];

    public function icon():belongsTo
    {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function club():belongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}
