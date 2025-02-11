<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExamFieldIdToCourseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_users', function (Blueprint $table) {
            $table->foreignId('exam_field_id')->nullable()->constrained('exam_fields');
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
            $table->dropForeign(['exam_field_id']);
            $table->dropColumn('exam_field_id');
        });
    }
}
