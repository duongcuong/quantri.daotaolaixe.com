<?php

namespace App;

use App\Http\Controllers\Backend\ExamFieldController;
use App\Http\Controllers\Backend\ModuleController;
use App\Http\Controllers\Backend\NotificationController;
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
use App\Http\Controllers\Backend\ActivityLogController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\CourseUserController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ExamScheduleController;
use App\Http\Controllers\Backend\FeeController;
use App\Http\Controllers\Backend\ImportController;
use App\Http\Controllers\Backend\LeadController;
use App\Http\Controllers\Backend\LeadSourceController;
use App\Http\Controllers\Backend\SaleController;
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

        Route::get('teachers/data', [TeacherController::class, 'data'])->name('teachers.data');
        Route::resource('teachers', TeacherController::class);

        Route::get('sales/data', [SaleController::class, 'data'])->name('sales.data');
        Route::resource('sales', SaleController::class);

        //course
        Route::get('courses/data', [CourseController::class, 'data'])->name('courses.data');
        Route::get('courses/list', [CourseController::class, 'list'])->name('courses.list');
        Route::resource('courses', CourseController::class);

        Route::get('users/list', [UserController::class, 'list'])->name('users.list');
        Route::get('users/{id}/detail', [UserController::class, 'detail'])->name('users.detail');
        Route::get('users/data', [UserController::class, 'data'])->name('users.data');
        Route::resource('users', UserController::class);

        // course-user
        Route::get('course-user/data', [CourseUserController::class, 'data'])->name('course-user.data');
        Route::get('course-user/list', [CourseUserController::class, 'list'])->name('course-user.list');
        Route::get('course-user/import', [CourseUserController::class, 'import'])->name('course-user.import');
        Route::post('course-user/import-file', [CourseUserController::class, 'importFile'])->name('course-user.importFile');
        Route::get('course-user/import-progress', [CourseUserController::class, 'importProgress'])->name('course-user.importProgress');
        Route::resource('course-user', CourseUserController::class);

        // fees
        Route::get('fees/data', [FeeController::class, 'data'])->name('fees.data');
        Route::resource('fees', FeeController::class);

        // calendars
        Route::get('calendars/data', [CalendarController::class, 'data'])->name('calendars.data');
        Route::get('calendars/learning', [CalendarController::class, 'learning'])->name('calendars.learning');
        Route::get('calendars/exam', [CalendarController::class, 'exam'])->name('calendars.exam');
        Route::get('calendars/dat', [CalendarController::class, 'dat'])->name('calendars.dat');
        Route::get('calendars/learning-exam', [CalendarController::class, 'learningExam'])->name('calendars.learningExam');
        Route::resource('calendars', CalendarController::class);

        // exam field
        Route::get('exam-fields/list', [ExamFieldController::class, 'list'])->name('exam-fields.list');
        Route::get('exam-fields/data', [ExamFieldController::class, 'data'])->name('exam-fields.data');
        Route::resource('exam-fields', ExamFieldController::class);

        // Lead source
        Route::get('lead-sources/list', [LeadSourceController::class, 'list'])->name('lead-sources.list');
        Route::get('lead-sources/data', [LeadSourceController::class, 'data'])->name('lead-sources.data');
        Route::resource('lead-sources', LeadSourceController::class);

        // Lead
        Route::get('leads/data', [LeadController::class, 'data'])->name('leads.data');
        Route::get('leads/list', [LeadController::class, 'list'])->name('leads.list');
        Route::post('leads/convert_list', [LeadController::class, 'convert_list'])->name('leads.convert_list');
        Route::resource('leads', LeadController::class);

        //Activiti
        Route::resource('activities', ActivityController::class);

        // notification
        Route::get('notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::get('notifications/load', [NotificationController::class, 'loadMore'])->name('notifications.load');

        //Log
        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

        // exam-schedules
        Route::get('exam-schedules/data', [ExamScheduleController::class, 'data'])->name('exam-schedules.data');
        Route::resource('exam-schedules', ExamScheduleController::class);

        //Import
        Route::get('imports/data', [ImportController::class, 'data'])->name('imports.data');
        Route::get('imports/{id}', [ImportController::class, 'show'])->name('imports.show');
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
