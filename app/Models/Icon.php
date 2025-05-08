<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Icon extends Model
{
    protected $fillable = ['name', 'thumbnail'];

    public function websites():hasMany
    {
        return $this->hasMany(Website::class, 'icon_id');
    }
}
