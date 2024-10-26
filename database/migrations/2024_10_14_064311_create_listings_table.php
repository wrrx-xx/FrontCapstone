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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('body');
            $table->double('price');
            $table->string('address');
            $table->string('baranggay');
            $table->string('city');
            $table->enum('type', ['Apartment', 'House', 'Boarding house', 'Room']);
            $table->enum('availability', ['open', 'closed'])->default('open');
            $table->enum('reservation', ['open', 'closed'])->default('open');
            $table->double('reservation_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
