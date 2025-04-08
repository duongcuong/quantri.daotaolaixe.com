<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVehicleIdColumnInAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Thay đổi kiểu dữ liệu của vehicle_id thành unsignedBigInteger và thêm khóa ngoại
            $table->unsignedBigInteger('vehicle_id')->nullable()->change();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Xóa khóa ngoại và khôi phục kiểu dữ liệu cũ
            $table->dropForeign(['vehicle_id']);
            $table->string('vehicle_id')->change();
        });
    }
}
