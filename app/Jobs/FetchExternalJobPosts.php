<?php

namespace App\Jobs;

use App\Actions\CreateExternalJobPost;
use App\Services\ExternalJobPostService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchExternalJobPosts implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ExternalJobPostService $externalJobPostService, CreateExternalJobPost $action): void
    {
        \Log::info('Fetching external job posts...');
        try {
            $posts = $externalJobPostService->fetchPosts();
            if ($posts) {
                foreach ($posts as $post) {
                    $action->handle($post);
                }

                \Log::info('Fetched external job posts', ['count' => count($posts)]);
            }
        } catch (\Exception $e) {
            \Log::error('Unable to fetch external post', ['error'=> $e]);
        }
    }
}
