<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'position', 'skills', 'certificate', 'linkedin_url',
        'description', 'photo_path', 'order'
    ];
}
