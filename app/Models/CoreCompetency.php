<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreCompetency extends Model
{
    protected $table = 'core_competencies';

    protected $fillable = ['name', 'order'];
}
