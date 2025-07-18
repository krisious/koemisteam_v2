<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MemberContact extends Pivot
{
    protected $table = 'member_contacts';

    protected $fillable = ['id_member', 'id_contact', 'value'];

    // protected $casts = [
    //     'value' => 'string',
    // ];

    // public function contact()
    // {
    //     return $this->belongsTo(Contact::class, 'id_contact', 'id');
    // }

    // public function member()
    // {
    //     return $this->belongsTo(Member::class, 'id_member', 'id');
    // }
}
