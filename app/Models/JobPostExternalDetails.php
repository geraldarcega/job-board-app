<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobPostExternalDetails extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $updated_at = false;
    protected $fillable = [
        'subcompany',
        'office',
        'department',
        'recruiting_category',
        'seniority',
        'schedule',
        'years_of_experience',
        'keywords',
        'occupation',
        'occupation_category',
        'job_descriptions',
        'additional_offices',
        'created_at',
    ];
    public $casts = [
        'job_descriptions' => 'json',
        'additional_offices' => 'json',
    ];

    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(JobPost::class);
    }
}
