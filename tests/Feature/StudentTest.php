<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Student;
use App\Models\Opportunity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_belongs_to_a_user(): void
    {
        // -------------------------
        // Arrange
        // -------------------------
        $student = Student::factory()->create();

        // -------------------------
        // Act
        // -------------------------
        $user = $student->user;

        // -------------------------
        // Assert
        // -------------------------
        $this->assertNotNull($user);

        $this->assertEquals($student->user_id, $user->id);
    }

    public function test_student_has_many_activities(): void
    {
        // -------------------------
        // Arrange
        // -------------------------
        $student = Student::factory()->create();

        $company = Company::factory()->create();

        $opportunity = Opportunity::factory()->create([
            'company_id' => $company->id,
        ]);

        $activityOne = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
        ]);

        $activityTwo = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
        ]);

        // -------------------------
        // Act
        // -------------------------
        $activities = $student->activities;

        // -------------------------
        // Assert
        // -------------------------
        $this->assertCount(2, $activities);

        $this->assertTrue($activities->contains($activityOne));

        $this->assertTrue($activities->contains($activityTwo));
    }

    public function test_activity_belongs_to_student(): void
    {
        // -------------------------
        // Arrange
        // -------------------------
        $student = Student::factory()->create();

        $opportunity = Opportunity::factory()->create();

        $activity = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
        ]);

        // -------------------------
        // Act
        // -------------------------
        $relatedStudent = $activity->student;

        // -------------------------
        // Assert
        // -------------------------
        $this->assertNotNull($relatedStudent);

        $this->assertEquals($student->id, $relatedStudent->id);
    }
}