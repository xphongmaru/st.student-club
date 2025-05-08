<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Club extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'thumbnail',
        'status',
        'banner',
        'email',
        'phone',
        'address',
        'field_of_activity',
        'foundation_date',
        'members_count',
        'posts_count',
        'events_count',
        'followers_count',
        'likes_count',
        'owner_id',
        'content_type',
        'slogan',
        'status',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'club_user');
    }

    public function members(): HasMany
    {
        return $this->HasMany(Member::class);
    }

    public function roleClubs(): HasMany
    {
        return $this->HasMany(RoleClub::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'like');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follower');
    }

    public function categoryPosts(): HasMany
    {
        return $this->hasMany(CategoryPost::class, 'club_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'club_id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'club_id');
    }

    public function recruitmentClubs(): HasMany
    {
        return $this->hasMany(RecruitmentClub::class, 'club_id');
    }

    public function requestMemberClubs(): HasMany
    {
        return $this->hasMany(RequestMemberClub::class, 'club_id');
    }

    public function websites(): HasMany
    {
        return $this->hasMany(Website::class, 'club_id');
    }

    public function clubInviteUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'club_invite_user')
            ->withPivot('message','status')
            ->withTimestamps();
    }

    public function getUser($id)
    {
        return User::query()->where('id', $id)->first();
    }

    public function getRoleClub($club_id, $user_id)
    {

        $roles = RoleClub::query()->where('club_id', $club_id)->get();
        foreach ($roles as $role) {
            $hasRole = $role->user()->where('user_id', $user_id)->first();
            if ($hasRole) {
                return $role;
            }
        }
    }

}
