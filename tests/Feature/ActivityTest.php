<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Student;
use App\Models\Activity;
use App\Enums\ActivityType;
use App\Models\Opportunity;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        // ----------------------
        // Arrange
        // ----------------------
        $student = Student::factory()->create();

        // Create valid opportunity
        $company = Company::factory()->create();
        $opportunity = Opportunity::factory()->create([
            'company_id' => $company->id
        ]);

        $activity = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
            'activity_type' => ActivityType::Application->value,
        ]);

        // -----------------------------
        // ACT
        // -----------------------------
        // fresh() reloads from DB (so we test the cast that happens on retrieval).
        $fresh = $activity->fresh();

        // -----------------------------
        // ASSERT
        // -----------------------------
        $this->assertInstanceOf(ActivityType::class, $fresh->activity_type);
        $this->assertEquals(ActivityType::Application, $fresh->activity_type);
    }

    public function test_activity_type_defaults_when_omitted(): void
    {
        // -----------------------------
        // ARRANGE
        // -----------------------------
        $student = Student::factory()->create();
        $company = Company::factory()->create();
        $opportunity = Opportunity::factory()->create(['company_id' => $company->id]);

        // -----------------------------
        // ACT
        // -----------------------------
        // Your migration sets a DEFAULT for activity_type.
        // But your ActivityFactory ALWAYS sets activity_type, so we *cannot*
        // test the DB default using the factory.
        //
        // Instead we create the row manually and omit activity_type on purpose.
        $activity = Activity::create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
            'activity_date' => null,
            'notes' => null,
            'evidence_link' => null,
        ]);

        // -----------------------------
        // ASSERT
        // -----------------------------
        $fresh = $activity->fresh();

        // We expect the database to have inserted the default,
        // and the model cast to have turned it into an enum.
        $this->assertInstanceOf(ActivityType::class, $fresh->activity_type);
        $this->assertEquals(ActivityType::Application, $fresh->activity_type);
    }

    public function test_activity_date_can_be_null(): void
    {
        // -----------------------------
        // ARRANGE
        // -----------------------------
        $student = Student::factory()->create();
        $company = Company::factory()->create();
        $opportunity = Opportunity::factory()->create(['company_id' => $company->id]);

        // -----------------------------
        // ACT
        // -----------------------------
        // activity_date is nullable in your migration.
        $activity = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
            'activity_date' => null,
        ]);

        // -----------------------------
        // ASSERT
        // -----------------------------
        $this->assertDatabaseHas('activities', [
            'id' => $activity->id,
            'activity_date' => null,
        ]);
    }
}
