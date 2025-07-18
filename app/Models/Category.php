<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->hasMany(Project::class, 'id_category', 'id');
    }

    public function blog()
    {
        return $this->hasMany(Blog::class, 'id_category', 'id');
    }
}
