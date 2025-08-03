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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('cooperative_members')->onDelete('cascade');
            $table->string('title')->comment('Transaction title');
            $table->string('subtitle')->nullable()->comment('Transaction subtitle');
            $table->decimal('amount', 15, 2)->comment('Transaction amount');
            $table->enum('type', ['income', 'expense'])->comment('Transaction type');
            $table->enum('category', ['loan_payment', 'savings_deposit', 'product_purchase', 'transfer'])->comment('Transaction category');
            $table->timestamp('transaction_date')->comment('When the transaction occurred');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('member_id');
            $table->index('type');
            $table->index('category');
            $table->index(['member_id', 'transaction_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};