<?php

use Illuminate\Support\Facades\Route;
use Jenssegers\Mongodb\Connection;
use Illuminate\Support\Facades\DB;
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
Route::get('/check-mongodb-connection', function () {
    try {
        $connection = DB::connection();
        if ($connection instanceof Connection) {
            $connection->getMongoClient()->listDatabases();
            return "Connected to the MongoDB database!";
        } else {
            return "Not connected to the MongoDB database. Check your configuration.";
        }
    } catch (\Exception $e) {
        return "Failed to connect to the MongoDB database: " . $e->getMessage();
    }
});
