<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNgayHocDatToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->date('ngay_hoc_dat')->nullable()->after('ngay_hoc_cabin'); // Thêm cột ngày học DAT, không bắt buộc
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('ngay_hoc_dat'); // Xóa cột nếu rollback
        });
    }
}
