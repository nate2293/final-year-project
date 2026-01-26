<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Company;
use App\Models\Opportunity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_expected_columns()
    {
        $company = Company::factory()->create();
        $data = $company->toArray();

        // If your PK is company_id, this should exist
        $this->assertArrayHasKey('company_id', $data);

        $this->assertArrayHasKey('company_name', $data);
        $this->assertArrayHasKey('company_email', $data);
        $this->assertArrayHasKey('company_address', $data);
        $this->assertArrayHasKey('company_location', $data);
        $this->assertArrayHasKey('industry', $data);

        // optional but common:
        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('updated_at', $data);
    }

    public function test_company_has_many_opportunities()
    {
        $company = Company::factory()
            ->has(Opportunity::factory()->count(3), 'opportunities')
            ->create();

        $this->assertCount(3, $company->opportunities);
        $this->assertInstanceOf(Opportunity::class, $company->opportunities->first());

        // Make sure each opportunity points back to this company
        $this->assertTrue(
            $company->opportunities->every(fn ($opp) => $opp->company_id === $company->company_id)
        );
    }
}
