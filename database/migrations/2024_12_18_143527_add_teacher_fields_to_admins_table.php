<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherFieldsToAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->tinyInteger('gender')->default(0)->after('email'); // 0: Nam, 1: Nữ, 2: Khác
            $table->date('dob')->nullable()->after('gender');
            $table->string('identity_card')->nullable()->after('dob');
            $table->string('address')->nullable()->after('identity_card');
            $table->string('rank')->nullable()->after('address'); // A1, A2, A3, ...
            $table->string('license')->nullable()->after('rank');
            $table->string('card_name')->nullable()->after('license');
            $table->string('card_number')->nullable()->after('card_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['gender', 'dob', 'identity_card', 'address', 'rank', 'license', 'card_name', 'card_number']);
        });
    }
}
