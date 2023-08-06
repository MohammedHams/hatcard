<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\LoginController;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\NetworkController;
use App\Http\Controllers\Agent\CardController;
use App\Http\Controllers\Agent\CategoryCardController;
use App\Http\Controllers\Agent\CardReportController;
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

Route::post('/login',[LoginController::class,'login'])->name('agent.login');
Route::get('/',[LoginController::class,'index'])->name('login.index');

Route::group(['middleware' => 'agent.auth', 'prefix' => 'overview'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/network', NetworkController::class)->parameters([
        'network' => 'id',
    ]);
    Route::resource('/card-category', CategoryCardController::class)->parameters([
        'card-category' => 'id',
    ]);
    Route::resource('/card', CardController::class)->parameters([
        'card' => 'id',
    ]);
    Route::resource('/report', CardReportController::class)->parameters([
        'report' => 'id',
    ]);
    Route::get('/network/area/{cityId}', [NetworkController::class, 'getAreaByCityId']);
    Route::get('logout', [LoginController::class, 'logout'])->name('agent.logout');
    // Other routes that need the 'agent.auth' middleware can be added here
});
