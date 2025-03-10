<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseUserIdToImportRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_rows', function (Blueprint $table) {
            $table->unsignedBigInteger('course_user_id')->nullable()->after('import_log_id');

            // Thiết lập khóa ngoại
            $table->foreign('course_user_id')->references('id')->on('course_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_rows', function (Blueprint $table) {
            $table->dropForeign(['course_user_id']);
            $table->dropColumn('course_user_id');
        });
    }
}
