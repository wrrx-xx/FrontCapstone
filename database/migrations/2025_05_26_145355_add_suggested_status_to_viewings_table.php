<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, modify the viewing_status column to allow 'suggested' status
        DB::statement("ALTER TABLE viewings MODIFY COLUMN viewing_status ENUM('pending', 'approved', 'declined', 'cancelled', 'suggested') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original status options
        DB::statement("ALTER TABLE viewings MODIFY COLUMN viewing_status ENUM('pending', 'approved', 'declined', 'cancelled') NOT NULL DEFAULT 'pending'");
    }
};
