<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNgayHocCabinToCourseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_users', function (Blueprint $table) {
            $table->date('ngay_hoc_cabin')->nullable()->after('ngay_be_giang');
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
            $table->dropColumn('ngay_hoc_cabin');
        });
    }
}
