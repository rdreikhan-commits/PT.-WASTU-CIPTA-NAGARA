<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name', 'client_company', 'rating', 'testimonial',
        'photo_path', 'is_approved', 'order'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];
}
