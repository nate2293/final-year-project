<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Activity;
use App\Models\Company;
use App\Models\Student;
use App\Models\Opportunity;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_belongs_to_a_user(): void
    {
        // -------------------------
        // Arrange
        // -------------------------
        // Student factorys creates a user automatically
        $student = Student::factory()->create();

        // -------------------------
        // Act
        // -------------------------
        // Triggers students belong to user class
        $user = $student->user;

        // -------------------------
        // Assert
        // -------------------------
        $this->assertNotNull($user);

        // this ensures FK matches actual users id
        $this->assertEquals($student->user_id, $user->id);
    }

    public function test_student_has_many_activities(): void
    {

        // ------------------------------
        // Arrange
        // ------------------------------
        $student = Student::factory()->create();

        $company = Company::factory()->create();
        $opportunity = Opportunity::factory()->create(['company_id' => $company->id]);

        // Create two activities for this student and this opportunity.
        $a1 = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
        ]);

        $a2 = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
        ]);

        // ---------------------------------
        // Act
        // ---------------------------------
        // Loads activities where student_id == student->id
        $activities = $student->activities;

        // ---------------------------------
        // ASSERT
        // ---------------------------------
        $this->assertCount(2, $activities);
        $this->assertTrue($activities->contains($a1));
        $this->assertTrue($activities->contains($a2));
    }
}
