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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Product name');
            $table->decimal('price', 15, 2)->comment('Product price');
            $table->enum('status', ['promo', 'baru', 'reguler'])->default('reguler')->comment('Product status');
            $table->text('description')->nullable()->comment('Product description');
            $table->string('category')->nullable()->comment('Product category');
            $table->boolean('is_active')->default(true)->comment('Product availability');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('status');
            $table->index('category');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};