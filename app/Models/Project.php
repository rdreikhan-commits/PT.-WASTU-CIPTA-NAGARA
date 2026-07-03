<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'client_id', 'title', 'slug', 'category', 'status', 'location', 'year',
        'project_value', 'scope', 'description', 'cover_image', 'video_url',
        'is_featured', 'order', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function galleries()
    {
        return $this->hasMany(ProjectGallery::class)->orderBy('id');
    }

    public function progress()
    {
        return $this->hasMany(ProjectProgress::class)->orderByDesc('date')->orderByDesc('id');
    }

    public function documents()
    {
        return $this->hasMany(ProjectDocument::class)->orderByDesc('created_at');
    }

    public function meetings()
    {
        return $this->hasMany(ProjectMeeting::class)->orderByDesc('meeting_date');
    }

    public function comments()
    {
        return $this->hasMany(ProjectComment::class)->orderBy('created_at');
    }

    public function approvals()
    {
        return $this->hasMany(ProjectApproval::class)->orderByDesc('created_at');
    }
}
