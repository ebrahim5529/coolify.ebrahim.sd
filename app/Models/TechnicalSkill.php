<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalSkill extends Model
{
    protected $table = 'technical_skills';

    protected $fillable = ['category', 'skills', 'order'];

    protected $casts = [
        'skills' => 'array',
    ];
}
