<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'club_id',
        'full_name',
        'code',
        'email',
        'phone',
        'address',
        'gender',
        'date_of_birth',
        'faculty',
        'class_name',
        'thumbnail',
        'role_club_id',
    ];

    public function club(): BelongsTo
    {
        return $this->BelongsTo(Club::class);
    }

    public function role(): BelongsTo
    {
        return $this->BelongsTo(Role::class, 'role_club_id');
    }
}
