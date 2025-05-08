<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class , 'faculty_id');
    }

    public function RequestMemberClubs(): HasMany
    {
        return $this->hasMany(RequestMemberClub::class , 'faculty_id');
    }
}
