<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->change();
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->tinyInteger('status')->default(null)->change();
        });
    }
}
