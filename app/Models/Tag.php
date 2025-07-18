<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsToMany(Project::class, 'project_tags', 'id_tag', 'id_project');
    }

    public function blog()
    {
        return $this->belongsToMany(Blog::class, 'blog_tags', 'id_tag', 'id_blog');
    }
}
