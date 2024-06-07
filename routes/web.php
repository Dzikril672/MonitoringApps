<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'home']);
Route::get('/monitoring', [MonitoringController::class, 'monitoring']);
Route::get('/profil', [ProfilController::class, 'profil']);
Route::get('/timeline', [MonitoringController::class, 'timeline']);
Route::get('/updateprofil', [UpdateController::class,'updateprofil']);
// Route::get('/test', [MonitoringController::class, 'index']);
