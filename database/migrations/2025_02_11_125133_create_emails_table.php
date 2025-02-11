<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('to');
            $table->string('subject');
            $table->string('template');
            $table->json('params')->nullable();
            $table->string('status')->default('pending');
            $table->text('log')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
