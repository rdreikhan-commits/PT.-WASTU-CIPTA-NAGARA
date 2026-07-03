<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    protected $fillable = ['project_id', 'file_path', 'file_type'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
