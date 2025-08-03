<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('cooperative_members')->onDelete('cascade');
            $table->string('loan_type')->comment('Type of loan (TV, Kulkas, etc.)');
            $table->string('product_name')->comment('Specific product name');
            $table->decimal('amount', 15, 2)->comment('Loan amount');
            $table->decimal('remaining_balance', 15, 2)->comment('Remaining balance');
            $table->enum('status', ['active', 'paid_off', 'overdue'])->default('active');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('member_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};