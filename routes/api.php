<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PigController;
use App\Http\Controllers\Api\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['as' => 'users.', 'prefix' => 'users', 'middleware' => 'auth:api'], function () {
    Route::get('/', [UserController::class, 'index']);
});

Route::group(['as' => 'pigs.', 'prefix' => 'pigs', 'middleware' => 'auth:api'], function () {
    Route::get('/index', [PigController::class, 'index']);
    Route::get('/show', [PigController::class, 'show']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login',[AuthController::class, 'login']);
    Route::post('send-otp', [AuthController::class, 'sendOTP']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

