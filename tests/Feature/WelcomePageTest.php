<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test welcome page loads successfully.
     */
    public function test_welcome_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('welcome')
        );
    }

    /**
     * Test welcome page shows login/register for guests.
     */
    public function test_welcome_page_shows_auth_links_for_guests(): void
    {
        $response = $this->get('/');

        $response->assertInertia(fn (Assert $page) => $page
            ->component('welcome')
            ->where('auth.user', null)
        );
    }

    /**
     * Test welcome page shows dashboard link for authenticated users.
     */
    public function test_welcome_page_shows_dashboard_for_authenticated_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertInertia(fn (Assert $page) => $page
            ->component('welcome')
            ->where('auth.user.id', $user->id)
            ->where('auth.user.name', $user->name)
        );
    }

    /**
     * Test health check endpoint.
     */
    public function test_health_check_endpoint(): void
    {
        $response = $this->get('/health-check');

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'ok',
        ]);
        $response->assertJsonStructure([
            'status',
            'timestamp',
        ]);
    }
}