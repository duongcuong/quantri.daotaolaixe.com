<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade'); // Liên kết với bảng vehicles
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade'); // Liên kết với bảng admins
            $table->string('type'); // Loại chi phí (do_xang, bao_duong, ...)
            $table->dateTime('expense_date'); // Thời gian chi phí
            $table->decimal('amount', 15, 2); // Số tiền
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_expenses');
    }
}
