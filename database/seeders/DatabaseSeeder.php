<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\PageSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\SettingBreedSeeder;
use Database\Seeders\SettingDiseaseSeeder;
use Database\Seeders\SettingExpenseSeeder;
use Database\Seeders\SettingVaccineSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(PermissionSeeder::class);
      $this->call(RoleSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(PageSeeder::class);
      $this->call(SettingSeeder::class);
      $this->call(CategorySeeder::class);
      $this->call(SettingBreedSeeder::class);
      $this->call(SettingDiseaseSeeder::class);
      $this->call(SettingExpenseSeeder::class);
      $this->call(SettingVaccineSeeder::class);
    }
}
