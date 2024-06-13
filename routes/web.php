<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TimelineController;
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

// Route::get('/', function () {
//     return view('auth.login');
// });

//Session untuk login user mobile
// Route::middleware(['guest:user']) -> group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/loginMobile', [AuthController::class, 'loginMobile']);
// });

// Route::middleware(['auth:user'])-> group(function () {

//     Route::get('/dashboard', [DashboardController::class, 'home']);
//     Route::get('/monitoring', [MonitoringController::class, 'monitoring']);
//     Route::get('/profil', [ProfilController::class, 'profil']);
//     Route::get('/timeline', [MonitoringController::class, 'timeline']);
//     Route::get('/updateprofil', [UpdateController::class,'updateprofil']);
//     // Route::get('/test', [MonitoringController::class, 'index']);
// });

Route::get('/dashboard', [DashboardController::class, 'home']);
Route::get('/monitoring', [MonitoringController::class, 'monitoring']);
Route::get('/profil', [ProfilController::class, 'profil'])->name('profil.profile');
Route::get('/timeline', [MonitoringController::class, 'timeline']);
Route::get('/updateprofil', [ProfilController::class, 'updateprofilview'])->name('updateprofil.view');
Route::post('/updateprofil', [ProfilController::class, 'updateprofil'])->name('updateprofil');
Route::get('/changepassword', [ProfilController::class,'changepass'])->name('changepassword');
Route::post('/logout', [ProfilController::class, 'logout'])->name('logout');


// Route::get('/test', [MonitoringController::class, 'index']);
