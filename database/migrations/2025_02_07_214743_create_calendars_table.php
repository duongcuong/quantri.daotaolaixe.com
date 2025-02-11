<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->tinyInteger('status')->default(0);
            $table->enum('priority', ['Low', 'Normal', 'High', 'Urgent'])->default('Normal');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->integer('duration');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('course_user_id')->nullable();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('course_user_id')->references('id')->on('course_users')->onDelete('set null');
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}
