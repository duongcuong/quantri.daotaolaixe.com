<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCoursesV2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('rank')->nullable()->change();
            $table->string('rank_gp')->nullable()->change();
            $table->string('number_bc')->nullable()->change();
            $table->date('date_bci')->nullable()->change();
            $table->date('start_date')->nullable()->change();
            $table->date('end_date')->nullable()->change();
            $table->bigInteger('tuition_fee')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('name')->unique();
            $table->string('rank')->nullable(false)->change();
            $table->string('rank_gp')->nullable(false)->change();
            $table->string('number_bc')->nullable(false)->change();
            $table->date('date_bci')->nullable(false)->change();
            $table->date('start_date')->nullable(false)->change();
            $table->date('end_date')->nullable(false)->change();
            $table->bigInteger('tuition_fee')->nullable(false)->change();
        });
    }
}
