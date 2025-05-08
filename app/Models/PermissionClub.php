<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PermissionClub extends Model
{
    protected $fillable = ['name', 'club_id'];

    public function rolePermissionClubs():BelongsToMany
    {
        return $this->belongsToMany(RoleClub::class, 'role_permission_club');
    }
}
