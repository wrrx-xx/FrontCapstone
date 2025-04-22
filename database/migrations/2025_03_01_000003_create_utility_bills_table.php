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
        Schema::create('utility_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_id')->constrained('billings')->cascadeOnDelete(); // Link to the billing
            $table->string('type'); // Type of utility (water or electricity)
            $table->decimal('amount', 10, 2); // Amount charged for the utility
            $table->decimal('reading', 10, 2); // Meter reading
            $table->string('status')->default('pending'); // Payment status
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utility_bills');
    }
};
