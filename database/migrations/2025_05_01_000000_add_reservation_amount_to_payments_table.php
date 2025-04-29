<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReservationAmountToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('reservation_amount', 10, 2)->default(0)->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('reservation_amount');
        });
    }
}
