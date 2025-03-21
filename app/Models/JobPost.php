<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobPost extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (JobPost $jobPost) {
            $suffix = Str::random(5);
            $jobPost->slug = Str::slug($jobPost->title . ' ' . $suffix);
        });
    }
}
