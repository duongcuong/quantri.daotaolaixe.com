<?php

namespace App;

use App\Http\Controllers\Backend\ModuleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PermissionController;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\backend\DashboardController;

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Backend\ActivityController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\CourseUserController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FeeController;
use App\Http\Controllers\Backend\LeadController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\UserController;

Route::prefix('admin')->as('admins.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('admins/list', [AdminController::class, 'list'])->name('admins.list');
        Route::resource('admins', AdminController::class);

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('modules', ModuleController::class);
        Route::resource('teachers', TeacherController::class);

        //course
        Route::get('courses/data', [CourseController::class, 'data'])->name('courses.data');
        Route::get('courses/list', [CourseController::class, 'list'])->name('courses.list');
        Route::resource('courses', CourseController::class);

        Route::get('users/list', [UserController::class, 'list'])->name('users.list');
        Route::get('users/{id}/detail', [UserController::class, 'detail'])->name('users.detail');
        Route::resource('users', UserController::class);

        // course-user
        Route::get('course-user/data', [CourseUserController::class, 'data'])->name('course-user.data');
        Route::get('course-user/list', [CourseUserController::class, 'list'])->name('course-user.list');
        Route::get('course-user/import', [CourseUserController::class, 'import'])->name('course-user.import');
        Route::post('course-user/import-file', [CourseUserController::class, 'importFile'])->name('course-user.importFile');
        Route::resource('course-user', CourseUserController::class);

        // fees
        Route::get('fees/data', [FeeController::class, 'data'])->name('fees.data');
        Route::resource('fees', FeeController::class);

        // Lead
        Route::get('leads/data', [LeadController::class, 'data'])->name('leads.data');
        Route::resource('leads', LeadController::class);

        //Activiti
        Route::resource('activities', ActivityController::class);
    });
});

Route::prefix('user')->group(function () {
    Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
    Route::post('login', [UserLoginController::class, 'login']);
    Route::post('logout', [UserLoginController::class, 'logout'])->name('user.logout');
});


Route::prefix('auth')->group(function () {
    Auth::routes(['register' => false]); // Disable registration routes if not needed
});

// Route::get('/clear', [DashboardController::class, 'cache'])->name('cache');
// //socialite
// Route::group(['as' => 'login.', 'prefix' => 'login'], function () {
//     Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('provider');
//     Route::get('/{provider}/callback', [LoginController::class, 'redirectToProviderCallback'])->name('providercallback');
// });

