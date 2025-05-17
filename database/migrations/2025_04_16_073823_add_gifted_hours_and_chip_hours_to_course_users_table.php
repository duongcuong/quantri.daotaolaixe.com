<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGiftedHoursAndChipHoursToCourseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_users', function (Blueprint $table) {
            $table->integer('gifted_hours')->nullable()->after('hours'); // Cột giờ tặng
            $table->integer('chip_hours')->nullable()->after('gifted_hours'); // Cột số giờ đặt chip
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_users', function (Blueprint $table) {
            $table->dropColumn('gifted_hours');
            $table->dropColumn('chip_hours');
        });
    }
}
