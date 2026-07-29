<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Opportunity;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_factory_persists_to_database(): void
    {
        // -------------------------
        // Arrange
        // -------------------------
        $company = Company::factory()->make();

        // -------------------------
        // Act
        // -------------------------
        $saved = $company->save();

        // -------------------------
        // Assert
        // -------------------------
        $this->assertTrue($saved);

        $this->assertDatabaseHas('companies', [
            'id' => $company->id,
            'company_email' => $company->company_email,
        ]);
    }

    public function test_company_email_must_be_unique(): void
    {
        // -------------------------
        // Arrange
        // -------------------------
        $email = 'unique@company.test';

        Company::factory()->create([
            'company_email' => $email,
        ]);

        // -------------------------
        // Act & Assert
        // -------------------------
        $this->expectException(QueryException::class);

        Company::factory()->create([
            'company_email' => $email,
        ]);
    }

    public function test_company_has_many_opportunities(): void
    {
        // -------------------------
        // Arrange
        // -------------------------
        $company = Company::factory()->create();

        $opp1 = Opportunity::factory()->create([
            'company_id' => $company->id,
        ]);

        $opp2 = Opportunity::factory()->create([
            'company_id' => $company->id,
        ]);

        // -------------------------
        // Act
        // -------------------------
        $opportunities = $company->opportunities;

        // -------------------------
        // Assert
        // -------------------------
        $this->assertCount(2, $opportunities);

        $this->assertTrue($opportunities->contains($opp1));

        $this->assertTrue($opportunities->contains($opp2));
    }

    public function test_opportunity_belongs_to_company(): void
    {
        // -------------------------
        // Arrange
        // -------------------------
        $company = Company::factory()->create();

        $opportunity = Opportunity::factory()->create([
            'company_id' => $company->id,
        ]);

        // -------------------------
        // Act
        // -------------------------
        $relatedCompany = $opportunity->company;

        // -------------------------
        // Assert
        // -------------------------
        $this->assertNotNull($relatedCompany);

        $this->assertEquals($company->id, $relatedCompany->id);
    }
}
