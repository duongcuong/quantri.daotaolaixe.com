<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSanitizedFileNameToImportLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_logs', function (Blueprint $table) {
            $table->string('sanitized_file_name')->nullable()->after('file_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_logs', function (Blueprint $table) {
            $table->dropColumn('sanitized_file_name');
        });
    }
}
