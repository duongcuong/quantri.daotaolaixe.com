<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('basic_status')->default(0); // 1: Đang học, 2: Chưa học, 3: Đã học
            $table->tinyInteger('shape_status')->default(0); // 1: Đang học, 2: Chưa học, 3: Đã học
            $table->tinyInteger('road_status')->default(0); // 1: Đang học, 2: Chưa học, 3: Đã học
            $table->tinyInteger('chip_status')->default(0); // 1: Đang học, 2: Chưa học, 3: Đã học
            $table->float('hours')->default(0);
            $table->float('km')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_users');
    }
}
