<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectProgressImage extends Model
{
    protected $fillable = ['project_progress_id', 'file_path'];

    public function progress()
    {
        return $this->belongsTo(ProjectProgress::class, 'project_progress_id');
    }
}
