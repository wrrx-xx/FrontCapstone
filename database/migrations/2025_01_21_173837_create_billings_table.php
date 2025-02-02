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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Link to the tenant
            $table->foreignId('listing_id')->constrained('listings')->cascadeOnDelete(); // Link to the listing
            $table->decimal('amount', 10, 2); // Amount to be billed
            $table->date('due_date'); // Due date for the payment
            $table->string('status')->default('pending'); // Payment status (pending, completed, failed)
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
