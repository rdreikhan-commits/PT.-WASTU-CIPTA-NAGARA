<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'thumbnail', 'category', 'tags',
        'seo_title', 'seo_description', 'seo_keywords', 'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
