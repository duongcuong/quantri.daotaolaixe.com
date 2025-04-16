<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCreatedByForeignInCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            // Xóa khóa ngoại hiện tại liên kết với bảng users
            $table->dropForeign(['created_by']);

            // Thay đổi khóa ngoại để liên kết với bảng admins
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null');
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
            // Xóa khóa ngoại liên kết với bảng admins
            $table->dropForeign(['created_by']);

            // Khôi phục khóa ngoại liên kết với bảng users
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }
}
