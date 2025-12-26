<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'content', 'image', 'category', 'date', 'read_time', 'keywords', 'published'];

    protected $casts = [
        'date' => 'date',
        'published' => 'boolean',
    ];
}
