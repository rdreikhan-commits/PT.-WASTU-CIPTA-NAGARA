<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDocument extends Model
{
    protected $fillable = ['project_id', 'title', 'file_path', 'file_type', 'file_size', 'uploaded_by'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
