<?php

namespace App\Actions;

use App\Models\JobPost;
use App\Models\JobPostExternalDetails;

final class CreateExternalJobPost
{
    /**
     * Execute the action.
     * 
     * @param array $attributes
     * @return void
     */
    public function handle(array $attributes): void
    {
        if (! isset($attributes['id']) || !$attributes['id'] ) {
            throw new \InvalidArgumentException('External job post id is required');
        }

        if (! $externalJob = JobPostExternalDetails::find($attributes['id']) ) {
            $post = JobPost::create([
                'external_id' => $attributes['id'],
                'title' => $attributes['name'],
                'description' => '',
                'posted_by' => 'external',
            ]);
            $post->externalDetails()->create([
                'subcompany' => $attributes['subcompany'] ?? null,
                'office' => $attributes['office'] ?? null,
                'department' => $attributes['department'] ?? null,
                'recruiting_category' => $attributes['recruitingCategory'] ?? null,
                'seniority' => $attributes['seniority'] ?? null,
                'schedule' => $attributes['schedule'] ?? null,
                'years_of_experience' => $attributes['yearsOfExperience'] ?? null,
                'keywords' => $attributes['keywords'] ?? null,
                'occupation' => $attributes['occupation'] ?? null,
                'occupation_category' => $attributes['occupationCategory'] ?? null,
                'job_descriptions' => $attributes['jobDescriptions'] ?? null,
                'additional_offices' => $attributes['additionalOffices'] ?? null,
                'created_at' => $attributes['createdAt'],
            ]);
        } else {
            $externalJob->update([
                'subcompany' => $attributes['subcompany'] ?? null,
                'office' => $attributes['office'] ?? null,
                'department' => $attributes['department'] ?? null,
                'recruiting_category' => $attributes['recruitingCategory'] ?? null,
                'seniority' => $attributes['seniority'] ?? null,
                'schedule' => $attributes['schedule'] ?? null,
                'years_of_experience' => $attributes['yearsOfExperience'] ?? null,
                'keywords' => $attributes['keywords'] ?? null,
                'occupation' => $attributes['occupation'] ?? null,
                'occupation_category' => $attributes['occupationCategory'] ?? null,
                'job_descriptions' => $attributes['jobDescriptions'] ?? null,
                'additional_offices' => $attributes['additionalOffices'] ?? null,
                'created_at' => $attributes['createdAt'],
            ]);

            if ($externalJob->jobPost?->title != $attributes['name']) {
                $externalJob->jobPost->update([
                    'title' => $attributes['name'],
                ]);
            }
        }
    }
}
