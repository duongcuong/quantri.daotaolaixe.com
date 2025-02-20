<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoGioChayDuocToCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            // Thêm cột so_gio_chay_duoc dưới dạng số phút
            $table->integer('so_gio_chay_duoc')->nullable()->after('diem_don');
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
            // Xóa cột so_gio_chay_duoc
            $table->dropColumn('so_gio_chay_duoc');
        });
    }
}
