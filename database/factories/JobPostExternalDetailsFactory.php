<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPostExternalDetails>
 */
class JobPostExternalDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subcompany' => $this->faker->company(),
            'office' => $this->faker->city(),
            'department' => $this->faker->words(3),
            'recruiting_category' => $this->faker->word(),
            'seniority' => $this->faker->word(),
            'schedule' => $this->faker->word(),
            'years_of_experience' => $this->faker->word(),
            'keywords' => $this->faker->words(3),
            'occupation' => $this->faker->word(),
            'occupation_category' => $this->faker->word(),
            'job_descriptions' => $this->faker->json(),
            'additional_offices' => $this->faker->json(),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
