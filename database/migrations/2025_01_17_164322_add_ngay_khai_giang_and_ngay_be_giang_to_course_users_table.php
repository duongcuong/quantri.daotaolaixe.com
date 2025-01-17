<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNgayKhaiGiangAndNgayBeGiangToCourseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_users', function (Blueprint $table) {
            $table->date('ngay_khai_giang')->nullable()->after('tuition_fee');
            $table->date('ngay_be_giang')->nullable()->after('ngay_khai_giang');
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
            $table->dropColumn('ngay_khai_giang');
            $table->dropColumn('ngay_be_giang');
        });
    }
}
