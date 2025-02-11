<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLeadsTableAddLeadSourceId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_source_id')->nullable()->after('user_id');
            $table->foreign('lead_source_id')->references('id')->on('lead_sources')->onDelete('set null');
            $table->dropColumn('source');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('source')->nullable()->after('user_id');
            $table->dropForeign(['lead_source_id']);
            $table->dropColumn('lead_source_id');
        });
    }
}
