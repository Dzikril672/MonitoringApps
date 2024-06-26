<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TestController;
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

//session 
// Route::get('/', function (){ return view('auth.login');})->name('login');
// Route::post('/loginMobile', [AuthController::class, 'loginMobile']);

// Route untuk user yang belum login (Guest)
Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login'); // Perhatikan nama route 'login', pastikan tidak bertabrakan dengan default

    Route::post('/loginMobile', [AuthController::class, 'loginMobile'])->name('login.mobile');
});

// Route untuk user yang sudah login (Authenticated)
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [ProfilController::class, 'logout'])->name('logout');
    
    // Profil
    Route::get('/profil', [ProfilController::class, 'profil'])->name('profil.profile');
    Route::get('/updateprofil', [ProfilController::class, 'updateprofilview'])->name('updateprofil.view');
    Route::post('/updateprofil', [ProfilController::class, 'updateprofil'])->name('updateprofil');
    Route::get('/changepassword', [ProfilController::class, 'changepass'])->name('changepassword');
    Route::post('/change-password', [ProfilController::class, 'changePassword'])->name('password.change');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');
    Route::get('/search-belumselesai', [DashboardController::class, 'searchBelumSelesai'])->name('search.belumselesai');
    Route::get('/search-berjalan', [DashboardController::class, 'searchBerjalan'])->name('search.berjalan');
    
    // Monitoring
    Route::get('/monitoring', [MonitoringController::class, 'monitoring'])->name('monitoring');
    
    // Test
    Route::get('/testmonitoring', [TestController::class, 'index'])->name('test');
    Route::get('/get-dashboard-lpp', [TestController::class, 'getDashboardLpp'])->name('get_dashboard_lpp');
    Route::get('/getmonitoring', [TestController::class, 'index'])->name('monitoring.index');
});



