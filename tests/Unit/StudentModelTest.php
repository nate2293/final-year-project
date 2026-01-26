<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Student;
use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_expected_columns()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $data = $student->toArray();

        // Your PK is student_id (confirmed in model)
        $this->assertArrayHasKey('student_id', $data);

        $this->assertArrayHasKey('user_id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('phone_number', $data);
        $this->assertArrayHasKey('address', $data);
        $this->assertArrayHasKey('university', $data);
        $this->assertArrayHasKey('linkedin_profile', $data);

        // If students table has timestamps, these should exist
        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('updated_at', $data);
    }

    public function test_student_belongs_to_user()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $student->user);
        $this->assertEquals($user->id, $student->user->id);
    }
    
    public function test_student_has_many_applications()
    {
        $user = User::factory()->create();

        $student = Student::factory()->create([
            'user_id' => $user->id,
        ]);

        Activity::factory()->count(3)->create([
            'student_id' => $student->student_id,
        ]);

        $this->assertCount(3, $student->applications);
        $this->assertInstanceOf(Activity::class, $student->applications->first());
    }
}
