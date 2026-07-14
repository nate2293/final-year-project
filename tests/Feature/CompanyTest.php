<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Opportunity;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    // Use refresh database wipes and re-runs migrations for each test
    // Keeping tests isolated
    use RefreshDatabase;

    public function test_company_factory_persists_to_database(): void
    {
        // -------------------------
        // Use Arrange, Act % Assert
        //--------------------------
        // Arrange: Set-up test data 
        // The factory creates a Company Object 
        // Not saved to the database
        $company = Company::factory()->make();

        // -------------------------
        // Act: Perform actioon
        // -------------------------
        // save() writes to the database. 
        $saved = $company->save();

        // -------------------------
        // Assert: we are confirming expected result.
        // -------------------------
        $this->assertTrue($saved);

        // assertdatabase checks rows exist with the values.
        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'company_email' => $company->company_email,
        ]);
    }

    // Using camel case as its better readability (for testing purposes)
    public function test_company_email_must_be_unique(): void 
    {
        // --------------------------
        // Arrange
        // --------------------------
        // Migration specifies email is unique 
        // Rejects if any duplicates

        $email = 'unique@company.test';

        Company::factory()->create(['company_email' => $email]);

        // ----------------------------
        // Act & Assert
        // ----------------------------

        $this->expectException(QueryException::class);

        Company::factory()->create(['company_email' => $email]);
    }

    public function test_company_has_many_opportunities(): void 
    {
        // -------------------------------
        // Arrange 
        // -------------------------------

        // Make company first
        $company = Company::factory()->create();

        // Opportunity migration requires company_id (foreign key),
        // but your OpportunityFactory does NOT set company_id by default.
        // Pass it here in the test to satisfy the schema.
        $opp1 = Opportunity::factory()->create(['company_id' => $company->id]);
        $opp2 = Opportunity::factory()->create(['company_id' => $company->id]);

        // -------------------------------
        // Act
        // -------------------------------
        $opps = $company->opportunities;

        // -------------------------------
        // Assert
        // -------------------------------
        $this->assertCount(2, $opps);

        // contains() checks the collection includes these specific models.
        $this->assertTrue($opps->contains($opp1));
        $this->assertTrue($opps->contains($opp2));
    }


}