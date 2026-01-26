<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Activity;
use App\Models\Opportunity;
use App\Models\Student;
use App\Models\Cv;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationModelTest extends TestCase
{
    use RefreshDatabase;        // Wipes database after every test

    // If migration breaks, renamed, or schema changes = FAIL.
    // Ensures that application model matches expected schema.
    // Model intergrity test
    public function test_application_expected_columns()
    {
        $application = Activity::factory()->create();

        $this->assertArrayHasKey('id', $application->toArray());
        $this->assertArrayHasKey('student_id', $application->toArray());
        $this->assertArrayHasKey('opportunity_id', $application->toArray());
        $this->assertArrayHasKey('application_date', $application->toArray());
        $this->assertArrayHasKey('status', $application->toArray());
        $this->assertArrayHasKey('cover_letter', $application->toArray());
    }

    public function test_application_belongs_to_student()
    {
        $application = Activity::factory()->create();

        $this->assertInstanceOf(Student::class, $application->student);
    }

    public function test_application_belongs_to_opportunity()
    {
        $application = Activity::factory()->create();

        $this->assertInstanceOf(Opportunity::class, $application->opportunity);
    }

    public function test_application_has_one_cv()
    {
        $application = Activity::factory()
            ->has(Cv::factory())
            ->create();

        $this->assertInstanceOf(Cv::class, $application->cv);
    }
}
