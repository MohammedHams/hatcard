<?php

use Illuminate\Support\Facades\Route;
use Jenssegers\Mongodb\Connection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Agent\LoginController;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\NetworkController;
use App\Http\Controllers\Agent\CategoryCardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login',[LoginController::class,'index']);
Route::post('/login',[LoginController::class,'login'])->name('agent.login');

Route::group(['middleware' => 'agent.auth', 'prefix' => 'agent'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/network', NetworkController::class)->parameters([
        'network' => 'id',
    ]);
    Route::resource('/card-category', CategoryCardController::class)->parameters([
        'card-category' => 'id',
    ]);

    Route::get('/network/{cityId}', [NetworkController::class, 'getAreaByCityId']);
    Route::get('logout', [DashboardController::class, 'logout'])->name('agent.logout');
    // Other routes that need the 'agent.auth' middleware can be added here
});
