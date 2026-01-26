<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'company_email' => $this->faker->unique->companyEmail(),
            'company_address' => $this->faker->address(),
            'company_location' => $this->faker->city(),
            'industry' => $this->faker->randomElement([
                'Technology',
                'Finance',
                'Retail',
                'Hospitality',
                'Education',
                'Healthcare',
                'Manufacturing',
            ]),
        ];
    }
}
