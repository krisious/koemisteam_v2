<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLink extends Model
{
    protected $table = 'project_links';

    protected $fillable = ['id_project', 'id_link', 'url'];
}
