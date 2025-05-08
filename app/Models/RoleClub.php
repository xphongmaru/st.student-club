<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleClub extends Model
{
    protected $fillable = [
        'name',
        'club_id',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'role_club_id');
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role_club');
    }

    public function rolePermissionClubs(): BelongsToMany
    {
        return $this->belongsToMany(PermissionClub::class, 'role_permission_club');
    }

}
