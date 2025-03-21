<?php

namespace App\Actions;

use App\Models\JobPost;
use App\Models\User;
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
        $isPosterEmailNew = JobPost::where("email", $attributes["email"])->count() === 0;
        $jobPost = JobPost::create($attributes);

        if ($isPosterEmailNew) {
            // assuming the first user is the moderator
            $moderator = User::first();
            Notification::send($moderator, $jobPost);
        }
    }
}
