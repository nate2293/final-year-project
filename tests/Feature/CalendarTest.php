<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Company;
use App\Models\Activity;
use App\Models\Opportunity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CalendarTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guest_users_are_redirected_from_the_calendar_events_route()
    {
        $response = $this->get(route('calendar.events'));

        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function authenticated_users_can_access_calendar_events()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('calendar.events'));

        $response->assertOk();

        $response->assertHeader('Content-Type', 'application/json');
    }

    #[Test]
    public function activity_events_are_returned_in_the_calendar_feed()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $company = Company::factory()->create([
            'company_name' => 'OpenAI',
        ]);

        $opportunity = Opportunity::factory()->create([
            'company_id' => $company->id,
            'job_title' => 'Software Engineer',
        ]);

        Activity::factory()->create([
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
            'activity_type' => 'application',
            'notes' => 'Application submitted.',
            'activity_date' => now(),
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('calendar.events'));

        $response->assertOk();

        $response->assertJsonFragment([
            'title' => 'Application',
        ]);

        $response->assertJsonFragment([
            'company' => 'OpenAI',
        ]);

        $response->assertJsonFragment([
            'job' => 'Software Engineer',
        ]);
    }

    #[Test]
    public function application_deadlines_are_returned_in_the_calendar_feed()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create([
            'company_name' => 'Microsoft',
        ]);

        Opportunity::factory()->create([
            'company_id' => $company->id,
            'job_title' => 'Graduate Developer',
            'application_deadline' => now()->addDays(10),
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('calendar.events'));

        $response->assertOk();

        $response->assertJsonFragment([
            'title' => 'Deadline',
        ]);

        $response->assertJsonFragment([
            'company' => 'Microsoft',
        ]);

        $response->assertJsonFragment([
            'job' => 'Graduate Developer',
        ]);

        $response->assertJsonFragment([
            'type' => 'Application Deadline',
        ]);
    }
}