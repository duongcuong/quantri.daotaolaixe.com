<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('thumbnail')->nullable()->after('name');
            $table->tinyInteger('gender')->default(0)->after('email'); // 0: Nam, 1: Nữ, 2: Khác
            $table->date('dob')->nullable()->after('gender');
            $table->string('identity_card')->nullable()->after('dob');
            $table->string('address')->nullable()->after('identity_card');
            $table->string('card_name')->nullable()->after('address');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['thumbnail', 'gender', 'dob', 'identity_card', 'address', 'card_name', 'card_number']);
        });
    }
}
