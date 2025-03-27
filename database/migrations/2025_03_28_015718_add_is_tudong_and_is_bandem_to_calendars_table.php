<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsTudongAndIsBandemToCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->boolean('is_tudong')->nullable()->default(false)->after('km');
            $table->boolean('is_bandem')->nullable()->default(false)->after('is_tudong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendars', function (Blueprint $table) {
            $table->dropColumn(['is_tudong', 'is_bandem']);
        });
    }
}
