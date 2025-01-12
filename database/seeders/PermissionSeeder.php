<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Role Permission
        $moduleAppRole      = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppRole->id,
            'name'          => 'Access Role',
            'slug'          => 'app.roles.index'
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppRole->id,
            'name'          => 'Create Role',
            'slug'          => 'app.roles.create'
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppRole->id,
            'name'          => 'Edit Role',
            'slug'          => 'app.roles.edit'
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppRole->id,
            'name'          => 'Delete Role',
            'slug'          => 'app.roles.destroy'
        ]);

        //User Permission
        $moduleAppUser      = Module::updateOrCreate(['name' => 'User Management']);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppUser->id,
            'name'          => 'Access user',
            'slug'          => 'app.users.index'
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppUser->id,
            'name'          => 'Create user',
            'slug'          => 'app.users.create'
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppUser->id,
            'name'          => 'Edit user',
            'slug'          => 'app.users.edit'
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppUser->id,
            'name'          => 'Delete user',
            'slug'          => 'app.users.destroy'
        ]);

        // Settings
        $moduleAppSettings  = Module::updateOrCreate(['name' => 'Settings']);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppSettings->id,
            'name'          => 'General Settings',
            'slug'          => 'app.settings.general',
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppSettings->id,
            'name'          => 'Appearance Settings',
            'slug'          => 'app.settings.appearance',
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppSettings->id,
            'name'          => 'Database Settings',
            'slug'          => 'app.settings.database',
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppSettings->id,
            'name'          => 'Mail Settings',
            'slug'          => 'app.settings.mail',
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppSettings->id,
            'name'          => 'Socialite Settings',
            'slug'          => 'app.settings.socialite',
        ]);
        // Profile
        $moduleAppProfile   = Module::updateOrCreate(['name' => 'Profile']);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppProfile->id,
            'name'          => 'Update Profile',
            'slug'          => 'app.profile.update',
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppProfile->id,
            'name'          => 'Update Password',
            'slug'          => 'app.profile.password',
        ]);

        // Page management
        $moduleAppPage     = Module::updateOrCreate(['name' => 'Page Management']);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppPage->id,
            'name'         => 'Access Pages',
            'slug'         => 'app.pages.index',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppPage->id,
            'name'         => 'Create Page',
            'slug'         => 'app.pages.create',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppPage->id,
            'name'         => 'Edit Page',
            'slug'         => 'app.pages.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppPage->id,
            'name'         => 'Delete Page',
            'slug'         => 'app.pages.destroy',
        ]);

        // Menu management
        $moduleAppMenu     = Module::updateOrCreate(['name' => 'Menu Management']);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppMenu->id,
            'name'         => 'Access Menus',
            'slug'         => 'app.menus.index',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppMenu->id,
            'name'         => 'Create Menu',
            'slug'         => 'app.menus.create',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppMenu->id,
            'name'         => 'Edit Menu',
            'slug'         => 'app.menus.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppMenu->id,
            'name'         => 'Delete Menu',
            'slug'         => 'app.menus.destroy',
        ]);

        //Admin Premission
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppDashboard->id,
            'name'          => 'Access Dashboard',
            'slug'          => 'app.dashboard'
        ]);
        
        // Customer
        $moduleAppCustommerProfile   = Module::updateOrCreate(['name' => 'Custommer']);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppCustommerProfile->id,
            'name'          => 'Update custommer Profile',
            'slug'          => 'app.custommerprofile.update',
        ]);
        Permission::updateOrCreate([
            'module_id'     => $moduleAppCustommerProfile->id,
            'name'          => 'Update custommer Password',
            'slug'          => 'app.custommerprofile.password',
        ]);

        // brand management
        $moduleAppBrand     = Module::updateOrCreate(['name' => 'Brand Management']);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppBrand->id,
            'name'         => 'Access Brands',
            'slug'         => 'app.brands.index',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppBrand->id,
            'name'         => 'Create Brand',
            'slug'         => 'app.brands.create',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppBrand->id,
            'name'         => 'Edit Brand',
            'slug'         => 'app.brands.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppBrand->id,
            'name'         => 'Delete Brand',
            'slug'         => 'app.brands.destroy',
        ]);

        // Category management
        $moduleAppCategories     = Module::updateOrCreate(['name' => 'Category Management']);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppCategories->id,
            'name'         => 'Access Category',
            'slug'         => 'app.categories.index',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppCategories->id,
            'name'         => 'Create Category',
            'slug'         => 'app.categories.create',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppCategories->id,
            'name'         => 'Edit Category',
            'slug'         => 'app.categories.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppCategories->id,
            'name'         => 'Delete Category',
            'slug'         => 'app.categories.destroy',
        ]);


        // Slider management
        $moduleAppSliders     = Module::updateOrCreate(['name' => 'Slider Management']);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppSliders->id,
            'name'         => 'Access Slider',
            'slug'         => 'app.sliders.index',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppSliders->id,
            'name'         => 'Create Slider',
            'slug'         => 'app.sliders.create',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppSliders->id,
            'name'         => 'Edit Slider',
            'slug'         => 'app.sliders.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppSliders->id,
            'name'         => 'Delete Slider',
            'slug'         => 'app.sliders.destroy',
        ]);

        // Pigs management
        $moduleAppPigs     = Module::updateOrCreate(['name' => 'Pig Management']);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppPigs->id,
            'name'         => 'Access Pig',
            'slug'         => 'app.pig-centers.index',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppPigs->id,
            'name'         => 'Create Pig',
            'slug'         => 'app.pig-centers.create',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppPigs->id,
            'name'         => 'Edit Pig',
            'slug'         => 'app.pig-centers.edit',
        ]);
        Permission::updateOrCreate([
            'module_id'    => $moduleAppPigs->id,
            'name'         => 'Delete Pig',
            'slug'         => 'app.pig-centers.destroy',
        ]);
    }
}
