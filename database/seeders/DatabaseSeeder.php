<?php

namespace Database\Seeders;

use App\Enums\ActivityType;
use App\Enums\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use App\Models\Opportunity;
use App\Models\Activity;
use App\Models\Cv;
use Database\Factories\ActivityFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => Role::ADMIN
        ]);


        // Create Companys
        Company::factory()->count(5)->create()->after(function (Company $company) {
            $company->opportunities()->createMany(Opportunity::factory(rand(0, 5))->make()->toArray());
        });

        // Create students
        Student::factory()->count(5)->create()->after(function (Student $student) {
            $student->activities()->create(Activity::factory()->make([
                'activity_type'=> ActivityType::Application->value,
                'opportunity_id' => Opportunity::inRandomOrder()->first()->id
            ])->toArray());
        });


        $this->call([
            // other seeders
        ]);
    }
}
