<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;
use App\Models\Student;
use App\Models\Opportunity;
use App\Models\Activity;

use function PHPUnit\Framework\assertNotNull;

class OpportunityTest extends TestCase
{
    // Wipes and re-runs database, keepoing tests isolated
    use RefreshDatabase;

    public function test_opportunity_belongs_to_company(): void
    {
        // --------------------------
        // Arrange
        // --------------------------

        // Create parent record 
        $company = Company::factory()->create();

        // Create child and provide comapny_id
        $opportunity = Opportunity::factory()->create([
            'company_id' => $company->id,
        ]);

        // ---------------------------
        // Act
        // ---------------------------
        // Load the belongsTo relationship
        $relatedCompany = $opportunity->company;


        // ----------------------------
        // Assert
        // ----------------------------
        $this->assertNotNull($relatedCompany);

        // is() this checks model table / PK
        $this->assertTrue($relatedCompany->is($company));
    }

    public function test_opportunity_has_many_activities(): void
    {
        // -----------------------------
        // Arrange
        // -----------------------------

        $company = Company::factory()->create();

        $opportunity = Opportunity::factory()->create([
            'company_id' => $company->id
        ]);

        $student = Student::factory()->create();

        $a1 = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
        ]);

        $a2 = Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
        ]);

        // -----------------------------
        // ACT
        // -----------------------------
        // Loads activities where opportunity_id == $opportunity->id
        $activities = $opportunity->activities;

        // -----------------------------
        // ASSERT
        // -----------------------------
        $this->assertCount(2, $activities);
        $this->assertTrue($activities->contains($a1));
        $this->assertTrue($activities->contains($a2));
    }
}
