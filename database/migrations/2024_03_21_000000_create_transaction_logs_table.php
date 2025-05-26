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
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->nullable()->constrained('payments')->nullOnDelete();
            $table->foreignId('billing_id')->nullable()->constrained('billings')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // The user who made the transaction
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete(); // Admin who processed the transaction
            $table->decimal('amount', 10, 2);
            $table->decimal('cash_advance_amount', 10, 2)->nullable();
            $table->decimal('cash_advance_used', 10, 2)->nullable();
            $table->string('payment_method');
            $table->string('reference_number')->nullable();
            $table->string('status');
            $table->string('action_type'); // e.g., 'payment_created', 'payment_approved', 'payment_declined', 'billing_created'
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_logs');
    }
}; 