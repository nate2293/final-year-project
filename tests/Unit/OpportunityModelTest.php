<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Opportunity;
use App\Models\Company;
use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OpportunityModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_opportunity_expected_columns()
    {
        $opportunity = Opportunity::factory()->create();

        $data = $opportunity->toArray();

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('company_id', $data);
        $this->assertArrayHasKey('job_title', $data);
        $this->assertArrayHasKey('job_description', $data);
        $this->assertArrayHasKey('job_category', $data);
        $this->assertArrayHasKey('requirements', $data);
        $this->assertArrayHasKey('application_deadline', $data);

        // optional but common:
        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('updated_at', $data);
    }

    public function test_opportunity_belongs_to_company()
    {
        $opportunity = Opportunity::factory()->create();

        $this->assertInstanceOf(Company::class, $opportunity->company);
    }

    public function test_opportunity_has_many_applications()
    {
        $opportunity = Opportunity::factory()
            ->has(Activity::factory()->count(3), 'applications')
            ->create();

        $this->assertCount(3, $opportunity->applications);
        $this->assertInstanceOf(Activity::class, $opportunity->applications->first());

        // sanity: each application points back to this opportunity
        $this->assertTrue(
            $opportunity->applications->every(fn ($app) => $app->opportunity_id === $opportunity->id)
        );
    }
}
