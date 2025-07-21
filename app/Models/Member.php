<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->user?->name ?? '-';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function memberSkill()
    {
        return $this->belongsToMany(Skill::class, 'member_skills', 'id_member', 'id_skill');
    }

    public function memberContact()
    {
        return $this->belongsToMany(Contact::class, 'member_contacts', 'id_member', 'id_contact')
            ->using(MemberContact::class)
            ->withPivot('value')
            ->withTimestamps();
    }

    public function project()
    {
        return $this->hasMany(Project::class, 'id_member', 'id');
    }

    public function collabProject()
    {
        return $this->belongsToMany(Project::class, 'collaboration', 'id_member', 'id_project');
    }

    public function blog()
    {
        return $this->hasMany(Blog::class, 'id_member', 'id');
    }

    protected static function booted()
    {
        static::forceDeleted(function ($member) {
            // Hanya soft delete user saat force delete siswa
            $member->user?->delete();
        });

        // Jika kamu ingin restore user saat siswa di-restore
        static::restored(function ($member) {
            $member->user?->restore();
        });
    }
}
