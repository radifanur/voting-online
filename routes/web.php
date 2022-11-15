<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VotersController;
use App\Models\User;
use App\Models\Vote;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|x`
*/


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/ceklogin', [LoginController::class, 'authenticate'])->name('ceklogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/lupa-password', [LupaPasswordController::class, 'index'])->name('lupapassword');
Route::post('lupa-password', [LupaPasswordController::class, 'submit'])->name('lupapassword.submit');
Route::get('reset-password/{email}/{token}', [LupaPasswordController::class, 'showResetPassword'])->name('resetpassword.get');
Route::post('reset-password', [LupaPasswordController::class, 'ResetPassword'])->name('resetpassword.submit');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/veriftoken', [VerifController::class, 'verifToken'])->name('verif.token');
    Route::get('/kirimulang', [VerifController::class, 'kirimUlang'])->name('kirim.ulang');
    Route::post('/verified', [VerifController::class, 'verified'])->name('verified');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => ['is_admin']], function () {
        // Route Panitia
        Route::get('/panitia', [UserController::class, 'index'])->name('panitia.index');
        Route::post('/panitia/store', [UserController::class, 'store'])->name('panitia.store');
        Route::get('/panitia/edit/{id}', [UserController::class, 'edit'])->name('panitia.edit');
        Route::put('/panitia/update/{id}', [UserController::class, 'update'])->name('panitia.update');
        Route::get('/panitia/delete/{id}', [UserController::class, 'destroy'])->name('panitia.delete');
    });

    Route::group(['middleware' => ['is_panitia']], function (){
        // Route Pemilih
        Route::get('/pemilih', [UserController::class, 'pemilihIndex'])->name('pemilih.index');
        Route::get('/pemilih/edit/{id}', [UserController::class, 'PemiilihEdit'])->name('pemilih.edit');
        Route::put('/pemilih/update/{id}', [UserController::class, 'PemilihUpdate' ])->name('pemilih.update');
        Route::post('/pemilih/store', [UserController::class, 'pemilihStore'])->name('pemilih.store');
        Route::get('/pemilih/delete/{id}', [UserController::class, 'PemilihDestroy'])->name('pemilih.delete');

        // Route Periode
        Route::get('/periode', [PeriodeController::class, 'index'])->name('periode.index');
        Route::post('/periode/store', [PeriodeController::class, 'store'])->name('periode.store');
        Route::get('/periode/edit/{id}', [PeriodeController::class, 'edit'])->name('periode.edit');
        Route::put('/periode/update/{id}', [PeriodeController::class, 'update'])->name('periode.update');
        Route::get('/periode/delete/{id}', [PeriodeController::class, 'destroy'])->name('periode.delete');

        // Route Kelas
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
        Route::get('/kelas/delete/{id}', [KelasController::class, 'destroy'])->name('kelas.delete');

        // Route Kandidat
        Route::get('/kandidat', [KandidatController::class, 'index'])->name('kandidat.index');
        Route::get('/kandidat/tambah', [KandidatController::class, 'create'])->name('kandidat.tambah');
        Route::post('/kandidat/store', [KandidatController::class, 'store'])->name('kandidat.store');
        Route::get('/kandidat/{id}', [KandidatController::class, 'edit'])->name('kandidat.edit');
        Route::put('/kandidat/update/{id}', [KandidatController::class, 'update'])->name('kandidat.update');
        Route::get('/kandidat/delete/{id}', [KandidatController::class, 'destroy'])->name('kandidat.delete');

    });

    Route::group(['middleware' => ['verif', 'is_pemilih']], function (){

        // Route Vote
        Route::get('/vote', [VoteController::class, 'index'])->name('vote.index')->middleware('belum');
        Route::get('/vote/{id}', [VoteController::class, 'vote'])->name('voting')->middleware('belum');

    });

    // Route Perolehan suara
    Route::get('/suara', [VoteController::class, 'suara'])->name('suara');

    Route::get('/verifikasi', [VerifController::class, 'index'])->name('verif.index');
    Route::post('/verif', [VerifController::class, 'verif'])->name('verif.store');
    
    // Error
    Route::get('403', function(){
        return view('error.403');
    });

});

