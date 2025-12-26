<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $table = 'personal_info';

    protected $fillable = ['name', 'job_title', 'description', 'location', 'phone', 'email', 'whatsapp', 'profile_image', 'hero_image', 'professional_summary'];
}
