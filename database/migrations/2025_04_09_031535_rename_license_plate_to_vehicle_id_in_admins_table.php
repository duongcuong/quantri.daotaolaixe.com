<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLicensePlateToVehicleIdInAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Đổi tên cột license_plate thành vehicle_id
            $table->renameColumn('license_plate', 'vehicle_id');
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
            // Đổi lại tên cột vehicle_id thành license_plate
            $table->renameColumn('vehicle_id', 'license_plate');
        });
    }
}
