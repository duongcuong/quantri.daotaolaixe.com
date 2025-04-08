<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique(); // Biển số, bắt buộc và không được trùng
            $table->string('model')->nullable(); // Model, không bắt buộc
            $table->string('rank')->nullable(); // Hạng, không bắt buộc
            $table->string('type')->nullable(); // Loại, không bắt buộc
            $table->string('color')->nullable(); // Màu sắc, không bắt buộc
            $table->string('gptl_number')->nullable(); // Số GPTL, không bắt buộc
            $table->date('gptl_expiry_date')->nullable(); // Ngày hết hạn GPTL, không bắt buộc
            $table->year('manufacture_year')->nullable(); // Năm sản xuất, không bắt buộc
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
        Schema::dropIfExists('vehicles');
    }
}
