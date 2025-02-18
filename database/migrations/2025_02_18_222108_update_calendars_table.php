<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            // Chỉnh cột duration thành không bắt buộc
            $table->integer('duration')->nullable()->change();

            // Thêm cột học phí
            $table->bigInteger('tuition_fee')->nullable()->after('duration');

            // Thêm cột lý do
            $table->text('reason')->nullable()->after('tuition_fee');
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
            // Đổi lại cột duration thành bắt buộc
            $table->integer('duration')->nullable(false)->change();

            // Xóa cột học phí
            $table->dropColumn('tuition_fee');

            // Xóa cột lý do
            $table->dropColumn('reason');
        });
    }
}
