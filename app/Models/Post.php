<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'thumbnail',
        'status',
        'club_id',
        'user_id',
        'likes_count',
        'comments_count',
        'slug',
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoryPost(): BelongsTo
    {
        return $this->belongsTo(CategoryPost::class, 'category_post_id');
    }

    public function likePosts():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'like_posts')
            ->withPivot('user_id', 'post_id')
            ->withTimestamps();
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
