<?php

namespace Tests\Unit;

use App\Actions\CreateJobPost;
use App\Models\JobPost;
use App\Models\User;
use App\Notifications\FirstTimePostingJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class CreateJobPostTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * A basic unit test for checking if notification is fired when the job poster is new.
     */
    public function test_notification_for_posting_using_new_email(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $action = new CreateJobPost();
        $newJob = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'email' => $this->faker->email,
        ];
        $action->handle($newJob);

        Notification::assertCount(expectedCount: 1);
        Notification::assertSentTo($user, FirstTimePostingJob::class);
    }

    /**
     * A basic unit test for checking if notification is not fired when the job poster is existing.
     */
    public function test_no_notification_for_job_posting_with_existing_email(): void
    {
        Notification::fake();

        $testEmail = 'already@exists.com';
        User::factory(1)->make();
        JobPost::factory()->create([
            'posted_by' => $testEmail
        ]);
        // User::factory(1)->make();
        $action = new CreateJobPost();
        $newJob = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'email' => $testEmail,
        ];

        $action->handle($newJob);

        Notification::assertNothingSent();
        Notification::assertCount(0);
    }
}
