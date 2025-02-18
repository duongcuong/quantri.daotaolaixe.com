<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->enum('loai_hoc', ['ly_thuyet', 'thuc_hanh', 'mo_phong', 'duong_truong', 'chay_dat'])->nullable()->after('teacher_id');
            $table->decimal('km', 8, 2)->nullable()->after('loai_hoc');
            $table->string('so_xe')->nullable()->after('km');
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
            $table->dropColumn('loai_hoc');
            $table->dropColumn('km');
            $table->dropColumn('so_xe');
        });
    }
}
