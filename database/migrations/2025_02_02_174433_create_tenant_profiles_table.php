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
        Schema::create('tenant_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Links to the user
            $table->string('current_address')->nullable();
            $table->string('employment_status')->nullable();
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('valid_id_type')->nullable(); // Type of ID (e.g., "Driver's License", "Passport")
            $table->string('valid_id_front_path')->nullable(); // Path to the uploaded front of the ID
            $table->string('valid_id_back_path')->nullable(); // Path to the uploaded back of the ID
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_profiles');
    }
};
