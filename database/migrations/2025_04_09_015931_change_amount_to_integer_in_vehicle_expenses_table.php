<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAmountToIntegerInVehicleExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_expenses', function (Blueprint $table) {
            $table->integer('amount')->change(); // Thay đổi kiểu dữ liệu của cột amount thành int
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
            $table->decimal('amount', 15, 2)->change(); // Khôi phục kiểu dữ liệu về decimal nếu rollback
        });
    }
}
