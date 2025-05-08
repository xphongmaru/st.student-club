<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecruitmentClub extends Model
{
    protected $fillable = ['name', 'club_id', 'start_date', 'end_date'];

    public function club():BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function requestMemberClubs(): HasMany
    {
        return $this->hasMany(RequestMemberClub::class, 'recruitment_club_id');
    }
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
