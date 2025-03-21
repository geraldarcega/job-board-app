<?php

namespace App\Actions;

use App\Models\JobPost;
use App\Models\User;
use App\Notifications\FirstTimePostingJob;
use Illuminate\Support\Facades\Notification;

final class CreateJobPost
{
    /**
     * Execute the action.
     * 
     * @param array $attributes
     * @return void
     */
    public function handle(array $attributes): void
    {
        $isPosterEmailNew = JobPost::where("posted_by", $attributes["email"])->count() === 0;
        $jobPost = JobPost::create([
            'title' => $attributes['title'],
            'description' => $attributes['description'],
            'posted_by' => $attributes['email'],
        ]);

        if ($isPosterEmailNew) {
            // assuming the first user is the moderator
            $moderator = User::first();
            Notification::send($moderator, new FirstTimePostingJob($jobPost));
        }
    }
}
