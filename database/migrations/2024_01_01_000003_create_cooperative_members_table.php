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
        Schema::create('cooperative_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('member_number')->unique()->comment('Unique member identification number');
            $table->decimal('simpanan_pokok', 15, 2)->default(0)->comment('Basic mandatory savings');
            $table->decimal('simpanan_wajib', 15, 2)->default(0)->comment('Monthly mandatory savings');
            $table->decimal('simpanan_sukarela', 15, 2)->default(0)->comment('Voluntary savings');
            $table->decimal('total_pinjaman', 15, 2)->default(0)->comment('Total outstanding loans');
            $table->integer('unread_notifications')->default(0)->comment('Count of unread notifications');
            $table->timestamps();
            
            // Indexes for performance
            $table->index('member_number');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperative_members');
    }
};