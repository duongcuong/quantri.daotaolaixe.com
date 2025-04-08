<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoteToVehicleExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_expenses', function (Blueprint $table) {
            $table->text('note')->nullable()->after('amount'); // Thêm cột ghi chú
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_expenses', function (Blueprint $table) {
            $table->dropColumn('note'); // Xóa cột ghi chú
        });
    }
}
