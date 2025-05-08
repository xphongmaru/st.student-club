<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RequestMemberClub extends Model
{
    protected $fillable = [
        'user_id',
        'club_id',
        'status',
        'reason',
        'name',
        'email',
        'phone_number',
        'faculty_id',
        'advantage_and_disadvantage',
        'recruitment_club_id',
        'gender',
        'class',
        'code',
        'dateTime',
        'address',
        'content',
        'note',
    ];

    public function club():BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function recruitmentClub():belongsTo
    {
        return $this->belongsTo(RecruitmentClub::class, 'recruitment_club_id');
    }

    public function faculty():BelongsTo
    {
        return $this-> belongsTo(Faculty::class, 'faculty_id');
    }

    public function getFacultyName($id):string
    {
        $faculty = Faculty::query()->where('id', $id)->first();
        if ($faculty) {
            return $faculty->name;
        }
        return '';
    }
}
