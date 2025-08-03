<?php

namespace Tests\Feature;

use App\Models\CooperativeMember;
use App\Models\Loan;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CooperativeDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test dashboard page loads successfully for authenticated user.
     */
    public function test_dashboard_loads_successfully(): void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('dashboard')
            ->has('member')
            ->has('recent_transactions')
            ->has('promo_products')
        );
    }

    /**
     * Test dashboard creates cooperative member if not exists.
     */
    public function test_dashboard_creates_member_if_not_exists(): void
    {
        $user = User::factory()->create();
        
        $this->assertDatabaseMissing('cooperative_members', [
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)->get('/dashboard');

        $this->assertDatabaseHas('cooperative_members', [
            'user_id' => $user->id,
            'member_number' => 'KOP-' . str_pad($user->id, 6, '0', STR_PAD_LEFT),
        ]);
    }

    /**
     * Test dashboard displays existing member data.
     */
    public function test_dashboard_displays_existing_member_data(): void
    {
        $user = User::factory()->create();
        $member = CooperativeMember::factory()->create([
            'user_id' => $user->id,
            'member_number' => 'KOP-123456',
            'simpanan_pokok' => 1000000,
            'simpanan_wajib' => 2000000,
            'simpanan_sukarela' => 3000000,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertInertia(fn (Assert $page) => $page
            ->component('dashboard')
            ->where('member.member_number', 'KOP-123456')
            ->where('member.simpanan_pokok', '1000000.00')
            ->where('member.total_simpanan', 6000000)
        );
    }

    /**
     * Test menu action handling.
     */
    public function test_menu_actions_work(): void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post('/dashboard', [
            'action' => 'mutasi'
        ]);

        $response->assertRedirect('/transactions');
    }

    /**
     * Test dashboard shows recent transactions.
     */
    public function test_dashboard_shows_recent_transactions(): void
    {
        $user = User::factory()->create();
        $member = CooperativeMember::factory()->create(['user_id' => $user->id]);
        
        // Create some transactions
        Transaction::factory()->count(3)->create([
            'member_id' => $member->id,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertInertia(fn (Assert $page) => $page
            ->component('dashboard')
            ->has('recent_transactions', 3)
        );
    }

    /**
     * Test dashboard shows promo products.
     */
    public function test_dashboard_shows_promo_products(): void
    {
        $user = User::factory()->create();
        
        // Create promo products
        Product::factory()->count(2)->create(['status' => 'promo']);
        Product::factory()->count(2)->create(['status' => 'baru']);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertInertia(fn (Assert $page) => $page
            ->component('dashboard')
            ->has('promo_products', 4)
        );
    }
}