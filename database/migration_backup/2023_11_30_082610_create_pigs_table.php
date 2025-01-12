<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pigs', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('origin', 20)->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('type', 20)->nullable();
            $table->integer('breed')->nullable();
            $table->string('status', 20)->nullable();
            $table->timestamp('birthday')->nullable();
            $table->timestamp('started_date')->nullable();
            $table->integer('father')->nullable();
            $table->integer('mother')->nullable();
            
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('pigs');
    }
}
