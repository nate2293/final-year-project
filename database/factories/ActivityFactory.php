<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Student;
use App\Enums\ActivityType;
use App\Models\Activity;
use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // ensuring application always has valid opportunity
            'student_id' => Student::factory(),
            'opportunity_id' => Opportunity::factory(),
            'activity_date' => $this->faker->dateTimeBetween('-2 Months', 'Now')->format('Y-m-d H:i:s'),
            'activity_type' => $this->faker->randomElement(ActivityType::cases()),
            'notes' => $this->faker->paragraphs(3, true),

        ];
    }
}
