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
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('listings')->cascadeOnDelete();
            $table->boolean('wifi');
            $table->boolean('parking'); // Assuming you want to include parking as well
            $table->boolean('bathroom'); // Assuming you want to include bathroom as well
            $table->boolean('kitchen');
            $table->boolean('laundry');
            $table->boolean('gym');
            $table->boolean('projector_room');
            $table->boolean('back_yard');
            $table->boolean('front_yard');
            $table->boolean('attached_garage');
            $table->boolean('pool');
            $table->boolean('elevator');
            $table->boolean('school');
            $table->boolean('transportation_hub');
            $table->boolean('super_market');
            $table->boolean('clinic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
