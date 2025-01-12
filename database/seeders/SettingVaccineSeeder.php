<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingVaccineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('setting_vaccines')->delete();

        DB::table('setting_vaccines')->insert(array(
            [
                "id" => 1,
                "name" => "Vaccine 1",
                "quantity" => "2",
                "description" => "Đây là Vaccine 1",
                "created_at" => Carbon::now()->format('Y-m-d')
            ],
            [
                "id" => 2,
                "name" => "Vaccine 2",
                "quantity" => "3",
                "description" => "Đây là lợn Vaccine 2",
                "created_at" => Carbon::now()->format('Y-m-d'),
            ],
            [
                "id" => 3,
                "name" => "Vaccine 3",
                "quantity" => "4",
                "description" => "Đây là lợn Vaccine 3",
                "created_at" => Carbon::now()->format('Y-m-d'),
            ],
        ));
    }
}
