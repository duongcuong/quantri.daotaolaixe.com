<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLoaiHocInCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->enum('loai_hoc', ['ly_thuyet', 'thuc_hanh', 'mo_phong', 'duong_truong', 'chay_dat', 'cabin'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->enum('loai_hoc', ['ly_thuyet', 'thuc_hanh', 'mo_phong', 'duong_truong', 'chay_dat'])->nullable()->change();
        });
    }
}
