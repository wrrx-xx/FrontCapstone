<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('listings')->cascadeOnDelete(); // Link to the listing
            $table->double('amount', 10, 2); // Total amount after cash advance
            $table->double('cash_advance_amount', 10, 2)->nullable(); // Cash advance amount
            $table->enum('payment_method', ['cash', 'gcash']); // Payment method
            $table->string('reference_number')->nullable(); // Reference number for GCash payments
            $table->string('screenshot')->nullable(); // Path to the uploaded screenshot
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Payment status
            $table->unsignedInteger('processed_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
