<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMeeting extends Model
{
    protected $fillable = ['project_id', 'meeting_title', 'description', 'meeting_date', 'location_or_link'];

    protected $casts = [
        'meeting_date' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
