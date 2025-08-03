<?php

namespace Tests\Feature;

use App\Models\CooperativeMember;
use App\Models\Loan;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CooperativeModelsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test cooperative member creation and relationships.
     */
    public function test_cooperative_member_creation(): void
    {
        $user = User::factory()->create();
        
        $member = CooperativeMember::create([
            'user_id' => $user->id,
            'member_number' => 'KOP-123456',
            'simpanan_pokok' => 1000000,
            'simpanan_wajib' => 2000000,
            'simpanan_sukarela' => 3000000,
        ]);

        $this->assertInstanceOf(CooperativeMember::class, $member);
        $this->assertEquals('KOP-123456', $member->member_number);
        $this->assertEquals(6000000, $member->total_simpanan);
    }

    /**
     * Test loan creation and relationship.
     */
    public function test_loan_creation(): void
    {
        $member = CooperativeMember::factory()->create();
        
        $loan = Loan::create([
            'member_id' => $member->id,
            'loan_type' => 'TV',
            'product_name' => 'TV LED 42"',
            'amount' => 5000000,
            'remaining_balance' => 3000000,
            'status' => 'active',
        ]);

        $this->assertInstanceOf(Loan::class, $loan);
        $this->assertEquals('TV', $loan->loan_type);
        $this->assertEquals($member->id, $loan->member_id);
    }

    /**
     * Test transaction creation and relationship.
     */
    public function test_transaction_creation(): void
    {
        $member = CooperativeMember::factory()->create();
        
        $transaction = Transaction::create([
            'member_id' => $member->id,
            'title' => 'Test Transaction',
            'subtitle' => 'Test Subtitle',
            'amount' => 100000,
            'type' => 'income',
            'category' => 'savings_deposit',
            'transaction_date' => now(),
        ]);

        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertEquals('Test Transaction', $transaction->title);
        $this->assertEquals($member->id, $transaction->member_id);
    }

    /**
     * Test product creation.
     */
    public function test_product_creation(): void
    {
        $product = Product::create([
            'name' => 'TV LED 55"',
            'price' => 5999000,
            'status' => 'promo',
            'category' => 'Elektronik',
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('TV LED 55"', $product->name);
        $this->assertEquals('promo', $product->status);
    }

    /**
     * Test cooperative member model scopes and methods.
     */
    public function test_cooperative_member_methods(): void
    {
        $member = CooperativeMember::factory()->create([
            'simpanan_pokok' => 1000000,
            'simpanan_wajib' => 2000000,
            'simpanan_sukarela' => 3000000,
        ]);

        // Create some transactions
        Transaction::factory()->count(3)->create([
            'member_id' => $member->id,
        ]);

        $this->assertEquals(6000000, $member->total_simpanan);
        $this->assertCount(3, $member->getRecentTransactions(5));
    }
}