<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectApproval extends Model
{
    protected $fillable = ['project_id', 'title', 'description', 'file_path', 'status', 'revision_notes'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
