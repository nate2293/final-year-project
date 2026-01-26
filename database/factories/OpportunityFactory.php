<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Opportunity;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opportunity>
 */
class OpportunityFactory extends Factory
{
    protected $model = Opportunity::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Create company automatically.
            // 'company_id' => Company::factory(),

            'job_title' => $this->faker->randomElement([
                'Software Developer',
                'AI Intern',
                'IT Support Intern',
                'Web Developer',
                'Cyber Security Intern',
                'Data Analyst',
                'UI/UX Intern'
            ]),
            'job_description' => $this->faker->paragraphs(2, true),
            'job_category' => $this->faker->randomElement([
                'Software Development',
                'IT Support',
                'Data',
                'Design',
                'Security',
            ]),
            'requirements' => $this->faker->paragraphs(2, true),
            'application_deadline' => $this->faker->dateTimeBetween('now', '+2 months')->format('Y-m-d H:i:s'),
        ];
    }
}
