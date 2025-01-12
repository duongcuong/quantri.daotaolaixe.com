<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->enum('related_type', ['lead', 'opportunity']);
            $table->unsignedBigInteger('related_id');
            $table->enum('type', ['email', 'call', 'meeting', 'task']);
            $table->string('subject', 255);
            $table->text('description')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('duration');
            $table->unsignedBigInteger('assigned_to');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('assigned_to')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
