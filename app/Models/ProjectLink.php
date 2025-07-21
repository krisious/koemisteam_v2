<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectLink extends Pivot
{
    protected $table = 'project_links';

    protected $fillable = ['id_project', 'id_link', 'url'];
}
