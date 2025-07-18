<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tags', 'id_blog', 'id_tag');
    }
}
