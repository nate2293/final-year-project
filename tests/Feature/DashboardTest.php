<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function guest_users_are_redirected_to_login()
    {
        $response = $this->get(route('home'));

        $response->assertRedirect(route('login'));
    }

    #[Test]
    public function authenticated_users_can_view_the_dashboard()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('home'));

        $response->assertOk();
    }

    #[Test]
    public function dashboard_displays_the_statistics_cards()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('home'));

        $response->assertSee('Applications');
        $response->assertSee('Interviews');
        $response->assertSee('Assessments');
        $response->assertSee('Offers');
    }
}