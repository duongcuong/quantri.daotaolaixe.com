<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingBreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('setting_breeds')->delete();

        DB::table('setting_breeds')->insert(array(
            [
                "id" => 1,
                "name" => "Yorkshire",
                "description" => "Đây là lợn Yorkshire",
                "created_at" => Carbon::now()->format('Y-m-d')
            ],
            [
                "id" => 2,
                "name" => "Landrace",
                "description" => "Đây là lợn Landrace",
                "created_at" => Carbon::now()->format('Y-m-d'),
            ],
            [
                "id" => 3,
                "name" => "Duroc",
                "description" => "Đây là lợn Duroc",
                "created_at" => Carbon::now()->format('Y-m-d'),
            ],
        ));
    }
}
