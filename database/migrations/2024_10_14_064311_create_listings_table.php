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
        Schema::create('listings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();

            $table->string('title');

            $table->text('body');

            $table->decimal('price', 10, 2); // Use decimal for price

            $table->string('address');

            $table->string('baranggay');

            $table->string('city');

            $table->enum('type', ['Apartment', 'House', 'Boarding house', 'Room']);

            $table->enum('availability', ['open', 'closed'])->default('open');

            $table->enum('reservation', ['open', 'closed'])->default('open');

            $table->decimal('reservation_amount', 10, 2); // Use decimal for reservation amount

            $table->string('waiver_file')->nullable(); // Add waiver_file column

            $table->string('map_link')->nullable(); // Add map_link column

            $table->foreignId('tenant_id')->nullable()->constrained('users')->nullOnDelete(); // Add foreign key constraint for tenant_id

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
