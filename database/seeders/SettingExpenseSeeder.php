<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('setting_expenses')->delete();

        DB::table('setting_expenses')->insert(array(
            [
                "id" => 1,
                "name" => "Tiền điện",
                "unit" => "VNĐ",
                "description" => "Đây là tiền điện",
                "created_at" => Carbon::now()->format('Y-m-d')
            ],
            [
                "id" => 2,
                "name" => "Tiền thuê",
                "unit" => "VNĐ",
                "description" => "Đây là lợn Tiền thuê",
                "created_at" => Carbon::now()->format('Y-m-d'),
            ],
            [
                "id" => 3,
                "name" => "Tiền nước",
                "unit" => "VNĐ",
                "description" => "Đây là lợn Tiền nước",
                "created_at" => Carbon::now()->format('Y-m-d'),
            ],
        ));
    }
}
