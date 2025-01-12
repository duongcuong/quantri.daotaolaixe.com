<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingDiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('setting_diseases')->delete();

        DB::table('setting_diseases')->insert(array(
            [
                "id" => 1,
                "name" => "Chân tay miệng",
                "description" => "Đây là lợn Chân tay miệng",
                "created_at" => Carbon::now()->format('Y-m-d')
            ],
            [
                "id" => 2,
                "name" => "Lở mồm long móng",
                "description" => "Đây là lợn Lở mồm long móng",
                "created_at" => Carbon::now()->format('Y-m-d'),
            ],
            [
                "id" => 3,
                "name" => "Tai xanh",
                "description" => "Đây là lợn Tai xanh",
                "created_at" => Carbon::now()->format('Y-m-d'),
            ],
        ));
    }
}
