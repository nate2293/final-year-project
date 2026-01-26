<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            //Create user, attach to student.
            // 'user_id' => User::factory(),
            'user_id' => User::factory(),

            'name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'university' => $this->faker->randomElement([
                'Ulster University',
                'Queens University',
                'MIT',
                'UC Berkeley',
                'Oxford University',
                'UCL',
                'University of Manchester',
            ]),
            'linkedin_profile' => 'https://uk.linkedin.com/' . $this->faker->userName(),
        ];
    }
}
