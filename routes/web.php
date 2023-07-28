<?php

use Illuminate\Support\Facades\Route;
use Jenssegers\Mongodb\Connection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Agent\LoginController;
use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\NetworkController;
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
    Route::get('/network', [NetworkController::class, 'index'])->name('network.index');
    Route::post('/network/store', [NetworkController::class, 'store'])->name('network.store');
    Route::get('/network/create', [NetworkController::class, 'create'])->name('network.create');
    Route::get('/network/edit/{id}', [NetworkController::class, 'edit'])->name('network.edit');
    Route::post('/network/update/{id}', [NetworkController::class, 'update'])->name('network.update');

    Route::get('/network/{cityId}', [NetworkController::class, 'getAreaByCityId']);
    Route::get('logout', [DashboardController::class, 'logout'])->name('agent.logout');
    Route::get('images/networks/{id}/{filename}',[NetworkController::class, 'showImage'])->name('networks.image');

    // Other routes that need the 'agent.auth' middleware can be added here
});
