<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    public function collaborator()
    {
        return $this->belongsToMany(Member::class, 'project_members', 'id_project', 'id_member');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tags', 'id_project', 'id_tag');
    }

    public function link()
    {
        return $this->belongsToMany(Link::class, 'project_links', 'id_project', 'id_link')
            ->using(ProjectLink::class)
            ->withPivot('url')
            ->withTimestamps();
    }
}
