<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public function member()
    {
        return $this->belongsToMany(Member::class, 'member_contacts', 'id_contact', 'id_member')
            ->using(MemberContact::class)
            ->withPivot('value')
            ->withTimestamps();
    }
}
