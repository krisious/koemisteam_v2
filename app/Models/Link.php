<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function project()
    {
        return $this->belongsToMany(Project::class, 'project_links', 'id_link', 'id_project')
            ->using(ProjectLink::class)
            ->withPivot('url')
            ->withTimestamps();
    }
}
