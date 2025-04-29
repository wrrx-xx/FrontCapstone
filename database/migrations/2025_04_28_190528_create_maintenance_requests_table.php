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
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id'); // assuming tenants are users
            $table->unsignedBigInteger('listing_id');
            $table->string('category'); // Plumbing, Electrical, etc.
            $table->enum('priority', ['Low', 'Medium', 'High', 'Urgent'])->default('Low');
            $table->string('title');
            $table->text('description');
            $table->string('photo_path')->nullable(); // uploaded photo
            $table->timestamp('preferred_schedule')->nullable();
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Cancelled'])->default('Pending');
            $table->unsignedBigInteger('assigned_caretaker_id')->nullable(); // optional
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('tenant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
            $table->foreign('assigned_caretaker_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
