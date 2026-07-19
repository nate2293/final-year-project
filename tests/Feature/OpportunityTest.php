<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use App\Models\Opportunity;
use App\Models\Activity;

class OpportunityTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_view_the_opportunity_index()
    {
        $user = User::factory()->create();

        Opportunity::factory()->count(5)->create();

        $response = $this
            ->actingAs($user)
            ->get(route('opportunities.index'));

        $response->assertOk();

        $response->assertViewIs('opportunities.index');

        $response->assertViewHas('opportunities');

        $response->assertViewHas('statusOptions');
    }

    #[Test]
    public function authenticated_user_can_search_for_an_opportunity()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create([
            'company_name' => 'Google',
        ]);

        Opportunity::factory()->create([
            'company_id' => $company->id,
            'job_title' => 'Software Engineer',
        ]);

        Opportunity::factory()->create([
            'job_title' => 'Cyber Security',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('opportunities.index', [
                'search' => 'Software',
            ]));

        $response->assertOk();

        $response->assertSee('Software');

        $response->assertDontSee('Cyber Security');
    }

    #[Test]
    public function authenticated_user_can_filter_opportunities_by_activity_type()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $applicationOpportunity = Opportunity::factory()->create();

        $interviewOpportunity = Opportunity::factory()->create();

        Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $applicationOpportunity->id,
            'activity_type' => 'application',
        ]);

        Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $interviewOpportunity->id,
            'activity_type' => 'interview',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('opportunities.index', [
                'status' => 'application',
            ]));

        $response->assertOk();

        $response->assertSee($applicationOpportunity->job_title);

        $response->assertDontSee($interviewOpportunity->job_title);
    }

    #[Test]
    public function authenticated_user_can_view_a_single_opportunity()
    {
        $user = User::factory()->create();

        $opportunity = Opportunity::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('opportunities.show', $opportunity));

        $response->assertOk();

        $response->assertViewIs('opportunities.show');

        $response->assertViewHas('opportunity', $opportunity);
    }
}