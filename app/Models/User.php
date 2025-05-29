<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sso_id',
        'status',
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
        'access_token',
    ];


    public function userRoles():BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function clubs():BelongsToMany
    {
        return $this->belongsToMany(Club::class, 'club_user');
    }

    public function roleClubs():BelongsToMany
    {
        return $this->belongsToMany(RoleClub::class, 'user_role_club');
    }

    public function likes():BelongsToMany
    {
        return $this->belongsToMany(Club::class, 'likes')
            ->withPivot('user_id', 'club_id')
            ->withTimestamps();
    }

    public function likePosts():BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'like_posts')
            ->withPivot('user_id', 'post_id')
            ->withTimestamps();
    }

    public function followers():BelongsToMany
    {
        return $this->belongsToMany(Club::class, 'followers')
            ->withPivot('user_id', 'club_id')
            ->withTimestamps();
    }

    public function notifications():HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function posts():HasMany
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function likeComments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'like_comments', 'comment_id', 'user_id')->withTimestamps();
    }

    public function request_clubs():HasMany
    {
        return $this->hasMany(RequestClub::class, 'user_id');
    }

    public function clubInviteUsers(): BelongsToMany
    {
        return $this->belongsToMany(Club::class, 'club_invite_user')
            ->withPivot('message', 'status')
            ->withTimestamps();
    }

    public function faculty():BelongsTo
    {
        return $this-> belongsTo(Faculty::class, 'faculty_id');
    }

    public function hasPermission(string $permission): bool
    {
        return $this->userRoles()
            ->whereHas('permissions', fn($q) => $q->where('name', $permission))
            ->exists();
    }


    public function hasRole(string $roleName): bool
    {
        return $this->userRoles()
            ->where('name', $roleName)
            ->exists();
    }

    public function hasRoleClub(string $roleName): bool
    {
        return $this->roleClubs()
            ->where('name', $roleName)
            ->exists();
    }

    public function hasPermissonClub(string $permission, int $club_id): bool
    {
        $clubId = $club_id;
        $user = Auth::user();

        $hasClub = $user->clubs()
            ->where('club_id', $clubId)->get();

        if ($hasClub->isEmpty()) {
            return false;
        }

        $roles = $user->roleClubs()->where('user_id', $user->id)->get();
        $hasRoles=[];
        foreach ($roles as $role) {
            if($role->club_id == $clubId) {
                $hasRoles[] = $role;
            }
        }
        $hasPermission=false;
        foreach ($hasRoles as $role) {
            $hasPermission = $role->rolePermissionClubs()->where('name', $permission)->exists();
        }

        return $hasPermission;
    }

    public function HasManagerClub()
    {
        $user = auth()->user();

        $roles = $user->roleClubs()->where('user_id', $user->id)->get();
        $Clubs_id= [];
        foreach ($roles as $role) {
            $permission= $role->rolePermissionClubs()->where('name', 'truy cập trang quản lý')->exists();
            if($permission){
                $club = Club::query()->where('id', $role->club_id)->first();
                if($club){
                    $Clubs_id[] = $role->club_id;
                }
            }
        }
        return $Clubs_id;
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

    public function isMemberOfClub($club_id): bool
    {
        return $this->clubs()->where('club_id', $club_id)->exists();
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

}
