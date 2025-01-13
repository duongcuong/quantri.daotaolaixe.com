<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCourseUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_users', function (Blueprint $table) {
            // Xoá các cột không cần thiết
            $table->dropColumn(['basic_status', 'shape_status', 'road_status', 'chip_status']);

            // Thêm các cột mới
            $table->timestamp('contract_date')->nullable();
            $table->boolean('theory_exam')->nullable();
            $table->boolean('practice_exam')->nullable();
            $table->boolean('graduation_exam')->nullable();
            $table->timestamp('graduation_date')->nullable();
            $table->foreignId('teacher_id')->nullable()->constrained('admins')->onDelete('cascade');
            $table->string('practice_field', 255)->nullable();
            $table->text('note')->nullable();
            $table->timestamp('health_check_date')->nullable();
            $table->foreignId('sale_id')->nullable()->constrained('admins')->onDelete('cascade');
            $table->timestamp('exam_date')->nullable();
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
            // Thêm lại các cột đã xoá
            $table->tinyInteger('basic_status')->default(0);
            $table->tinyInteger('shape_status')->default(0);
            $table->tinyInteger('road_status')->default(0);
            $table->tinyInteger('chip_status')->default(0);

            // Xoá các cột mới thêm
            $table->dropColumn([
                'contract_date',
                'theory_exam',
                'practice_exam',
                'graduation_exam',
                'graduation_date',
                'teacher_id',
                'practice_field',
                'note',
                'health_check_date',
                'sale_id',
                'exam_date'
            ]);
        });
    }
}
