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
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('id_type', ['student ID', 'work ID', 'drivers license', 'national ID', 'Postal ID', 'GSIS', 'PhilHealth'])->nullable();
            $table->string('id_number');
            $table->string('selfie_upload');
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->string('admin_note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
