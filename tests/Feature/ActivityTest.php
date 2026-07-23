<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

use App\Models\User;
use App\Models\Student;
use App\Models\Activity;
use App\Models\Opportunity;

use Illuminate\Http\UploadedFile;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_view_their_activity_index()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        Activity::factory()->count(3)->create([
            'student_id' => $student->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('activities.index'));

        $response->assertOk();
        $response->assertViewIs('activities.index');
        $response->assertViewHas('activities');
    }

    #[Test]
    public function authenticated_user_can_view_the_create_activity_page()
    {
        $user = User::factory()->create();

        Student::factory()->create([
            'user_id' => $user->id,
        ]);

        Opportunity::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('activities.create'));

        $response->assertOk();
        $response->assertViewIs('activities.create');
        $response->assertViewHas('activity');
        $response->assertViewHas('opportunityOptions');
        $response->assertViewHas('activityOptions');
    }

    #[Test]
    public function authenticated_user_can_create_an_activity()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $opportunity = Opportunity::factory()->create();

        $file = UploadedFile::fake()->create(
            'evidence.pdf',
            100,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->post(route('activities.store'), [
                'opportunity_id' => $opportunity->id,
                'activity_type' => 'application',
                'activity_date' => now()->toDateString(),
                'notes' => 'Submitted application.',
                'evidence_link' => $file,
            ]);

        $response->assertRedirect(route('activities.index'));

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('activities', [
            'student_id' => $student->id,
            'opportunity_id' => $opportunity->id,
            'notes' => 'Submitted application.',
        ]);
    }

    #[Test]
    public function activity_creation_requires_required_fields()
    {
        $user = User::factory()->create();

        Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('activities.create'))
            ->post(route('activities.store'), []);

        $response->assertRedirect(route('activities.create'));

        $response->assertSessionHasErrors([
            'opportunity_id',
            'activity_type',
            'evidence_link',
        ]);

        $this->assertDatabaseCount('activities', 0);
    }

    #[Test]
    public function authenticated_user_can_view_a_single_activity()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $activity = Activity::factory()->create([
            'student_id' => $student->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('activities.show', $activity));

        $response->assertOk();

        $response->assertViewIs('activities.show');

        $response->assertViewHas('activity', $activity);
    }

    #[Test]
    public function authenticated_user_can_view_the_edit_activity_page()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $activity = Activity::factory()->create([
            'student_id' => $student->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('activities.edit', $activity));

        $response->assertOk();

        $response->assertViewIs('activities.edit');

        $response->assertViewHas('activity', $activity);
        $response->assertViewHas('opportunityOptions');
        $response->assertViewHas('activityOptions');
    }

    #[Test]
    public function authenticated_user_can_update_an_activity()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $activity = Activity::factory()->create([
            'student_id' => $student->id,
            'notes' => 'Old notes',
        ]);

        $opportunity = Opportunity::factory()->create();

        $file = UploadedFile::fake()->create(
            'updated-evidence.pdf',
            100,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->put(route('activities.update', $activity), [
                'opportunity_id' => $opportunity->id,
                'activity_type' => 'application',
                'activity_date' => now()->toDateString(),
                'notes' => 'Updated notes',
                'evidence_link' => $file,
            ]);

        $response->assertRedirect(route('activities.index'));

        $this->assertDatabaseHas('activities', [
            'id' => $activity->id,
            'notes' => 'Updated notes',
        ]);
    }

    #[Test]
    public function authenticated_user_can_delete_an_activity()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $activity = Activity::factory()->create([
            'student_id' => $student->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('activities.destroy', $activity));

        $response->assertRedirect(route('activities.index'));

        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('activities', [
            'id' => $activity->id,
        ]);
    }
}
