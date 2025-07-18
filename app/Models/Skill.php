<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded = [];

    public function member()
    {
        return $this->belongsToMany(Skill::class, 'member_skills', 'id_skill', 'id_member');
    }
}
