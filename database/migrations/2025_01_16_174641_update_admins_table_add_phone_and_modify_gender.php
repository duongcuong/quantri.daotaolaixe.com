<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdminsTableAddPhoneAndModifyGender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Thêm cột phone
            $table->string('phone', 20)->nullable()->after('email');

            // Cập nhật cột gender để cho phép giá trị trống
            $table->string('gender')->nullable()->change();
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
            // Xóa cột phone
            $table->dropColumn('phone');

            // Đổi lại cột gender không cho phép giá trị trống
            $table->string('gender')->nullable(false)->change();
        });
    }
}
