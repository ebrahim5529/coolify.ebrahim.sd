<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'image', 'technologies', 'demo_url', 'github_url', 'order'];

    protected $casts = [
        'technologies' => 'array',
    ];
}
