<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryPost extends Model
{
    protected $fillable = [
        'name',
        'club_id',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function posts():HasMany
    {
        return $this->hasMany(Post::class, 'category_post_id');
    }
}
