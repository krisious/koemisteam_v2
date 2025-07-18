<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'id_skill', 'id');
    }
}
