<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCommentsTableMakeColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->unsignedBigInteger('calendar_id')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->unsignedTinyInteger('star')->nullable()->change();
            $table->boolean('status')->nullable()->change();
            $table->unsignedBigInteger('parent_id')->nullable()->change();
            $table->boolean('is_teacher')->nullable()->change();
            $table->boolean('is_user')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->unsignedBigInteger('calendar_id')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->unsignedTinyInteger('star')->nullable(false)->change();
            $table->boolean('status')->nullable(false)->change();
            $table->unsignedBigInteger('parent_id')->nullable(false)->change();
            $table->boolean('is_teacher')->nullable(false)->change();
            $table->boolean('is_user')->nullable(false)->change();
        });
    }
}
