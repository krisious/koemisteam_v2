<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberContact extends Model
{
    protected $table = 'member_contacts';

    protected $fillable = ['id_member', 'id_contact', 'value'];
}
