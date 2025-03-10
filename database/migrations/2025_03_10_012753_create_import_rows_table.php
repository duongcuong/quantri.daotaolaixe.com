<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_rows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_log_id');
            $table->json('row_data');
            $table->boolean('success');
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->foreign('import_log_id')->references('id')->on('import_logs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_rows');
    }
}
