<?php

namespace Tests\Unit;

use App\Actions\CreateJobPost;
use App\Models\JobPost;
use App\Models\User;
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
    public function test_notification_for_new_email(): void
    {
        Notification::fake();

        User::factory(1)->create();
        $action = new CreateJobPost();
        $newJob = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'email' => $this->faker->email,
        ];

        Notification::assertSentTo(User::first(), JobPost::class);

        $action->handle($newJob);
    }

    /**
     * A basic unit test for checking if notification is fired when the job poster is new.
     */
    // public function test_job_posting_with_existing_email(): void
    // {
    //     Notification::fake();

    //     $user = User::factory(1)->make();
    //     $action = new CreateJobPost();
    //     $newJob = [
    //         'title' => $this->faker->sentence,
    //         'description' => $this->faker->paragraph,
    //         'email' => $this->faker->email,
    //     ];

    //     Notification::assertSentTo(User::first(), JobPost::class);

    //     $action->handle($newJob);
    // }
}
