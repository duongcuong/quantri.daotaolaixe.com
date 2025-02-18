<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCalendarsTableAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            // Thêm cột ngày đóng học phí
            $table->timestamp('ngay_dong_hoc_phi')->nullable()->after('reason');

            // Thêm cột hạng thi
            $table->enum('hang_thi', ['A1', 'A2', 'B1', 'B2', 'C', 'D', 'E', 'F'])->nullable()->after('ngay_dong_hoc_phi');
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
            // Xóa cột ngày đóng học phí
            $table->dropColumn('ngay_dong_hoc_phi');

            // Xóa cột hạng thi
            $table->dropColumn('hang_thi');
        });
    }
}
