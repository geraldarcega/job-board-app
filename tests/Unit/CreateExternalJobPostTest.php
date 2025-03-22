<?php

namespace Tests\Unit;

use App\Actions\CreateExternalJobPost;
use App\Models\JobPost;
use App\Models\JobPostExternalDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use InvalidArgumentException;
use Tests\TestCase;

class CreateExternalJobPostTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * A basic unit test for inserting external job.
     */
    public function test_can_insert_external_job(): void
    {
        // setup
        $data = [
            'id' => $this->faker->randomNumber(1, 1000),
            'name' => $this->faker->words(4, true),
            'subcompany' => $this->faker->word(),
            'office' => $this->faker->word(),
            'department' => $this->faker->word(),
            'recruitingCategory' => $this->faker->word(),
            'seniority' => $this->faker->word(),
            'schedule' => $this->faker->word(),
            'yearsOfExperience' => $this->faker->word(),
            'keywords' => $this->faker->word(),
            'occupation' => $this->faker->word(),
            'occupationCategory' => $this->faker->word(),
            'jobDescriptions' => json_encode([
                'jobDescription' => [
                    [
                        'name' => $this->faker->words(5, true),
                        'value' => $this->faker->sentence(),
                    ]
                ],
            ]),
            'additionalOffices' => json_encode([ 'office' => 'remote', ]),
            'createdAt' => $this->faker->dateTime(),
        ];
        $action = new CreateExternalJobPost();
        $action->handle($data);

        $this->assertDatabaseHas(JobPost::class, [
            'external_id' => $data['id'],
            'title' => $data['name'],
            'posted_by' => 'external',
        ]);
        $this->assertDatabaseHas(JobPostExternalDetails::class, [
            'subcompany' => $data['subcompany'],
            'office' => $data['office'],
            'department' => $data['department'],
            'recruiting_category' => $data['recruitingCategory'],
            'seniority' => $data['seniority'],
            'schedule' => $data['schedule'],
            'years_of_experience' => $data['yearsOfExperience'],
            'keywords' => $data['keywords'],
            'occupation' => $data['occupation'],
            'occupation_category' => $data['occupationCategory'],
            'job_descriptions' => $data['jobDescriptions'],
            'additional_offices' => $data['additionalOffices'],
            'created_at' => $data['createdAt'],
        ]);
    }

        /**
     * A basic unit test for validating data without id.
     */
    public function test_throw_exception_when_external_id_is_missing(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('External job post id is required');

        // setup
        $data = [
            'name' => $this->faker->words(4, true),
            'subcompany' => $this->faker->word(),
            'office' => $this->faker->word(),
            'department' => $this->faker->word(),
            'recruitingCategory' => $this->faker->word(),
            'seniority' => $this->faker->word(),
            'schedule' => $this->faker->word(),
            'yearsOfExperience' => $this->faker->word(),
            'keywords' => $this->faker->word(),
            'occupation' => $this->faker->word(),
            'occupationCategory' => $this->faker->word(),
            'jobDescriptions' => json_encode([
                'jobDescription' => [
                    [
                        'name' => $this->faker->words(5, true),
                        'value' => $this->faker->sentence(),
                    ]
                ],
            ]),
            'additionalOffices' => json_encode(['office' => 'remote',]),
            'createdAt' => $this->faker->dateTime(),
        ];
        $action = new CreateExternalJobPost();
        $action->handle($data);
    }
}
