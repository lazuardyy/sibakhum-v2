<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Mahasiswa\PengajuanCutiController;
use App\Http\Controllers\Fakultas\PengunduranDiriController;
use App\Http\Controllers\Dosen\VerifikasiCutiController;
use App\Http\Controllers\Dosen\VerifikasiMdController;
use App\Http\Controllers\Fakultas\DataPengajuanController;
use App\Http\Controllers\Bakhum\BukaPeriodeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Http;

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
Route::get('/', [LoginController::class, 'index'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/attemptLogin', [LoginController::class, 'attemptLogin']);
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'pengajuan-cuti', 'as' => 'pengajuan-cuti.'], function () {
  Route::get('/create', [PengajuanCutiController::class, 'create'])->name('create');
  Route::post('/store', [PengajuanCutiController::class, 'store'])->name('store');
  Route::get('/{id}/edit', [PengajuanCutiController::class, 'edit'])->name('edit');
  Route::get('/status/{nim}', [PengajuanCutiController::class, 'show'])->name('show');
  Route::put('/{id}', [PengajuanCutiController::class, 'update'])->name('update');
  Route::delete('/{id}', [PengajuanCutiController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'data', 'as' => 'data-cuti.'], function () {
  Route::get('/pengajuan-cuti', [VerifikasiCutiController::class, 'index'])->name('index');
  Route::post('/cuti-store', [VerifikasiCutiController::class, 'store'])->name('store');
  Route::get('/details-cuti/{detail}', [VerifikasiCutiController::class, 'show'])->name('show');
  Route::delete('/{id}', [VerifikasiCutiController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'data', 'as' => 'data-md.'], function () {
  Route::get('/pengunduran-diri', [VerifikasiMdController::class, 'index'])->name('index');
  Route::post('/md-store', [VerifikasiMdController::class, 'store'])->name('store');
  Route::get('/details-md/{detail}', [VerifikasiMdController::class, 'show'])->name('show');
  Route::delete('/{id}', [VerifikasiMdController::class, 'destroy'])->name('destroy');
});


Route::group(['prefix' => 'data-pengajuan', 'as' => 'data-pengajuan.'], function () {
  Route::get('/', [DataPengajuanController::class, 'index'])->name('index');
  Route::get('/{detail}', [DataPengajuanController::class, 'show'])->name('show');
  Route::post('/store', [DataPengajuanController::class, 'store'])->name('store');
});

// Route::get('/data-pengajuan', [DataPengajuanController::class, 'index'])->name('data-pengajuan');
Route::resource('pengunduran-diri', PengunduranDiriController::class);

Route::get('riwayat-persetujuan', [HistoryController::class, 'index'])->name('history');

Route::group(['prefix' => 'buka-periode', 'as' => 'periode.'], function () {
  Route::get('/', [BukaPeriodeController::class, 'index'])->name('index');
  Route::post('/store', [BukaPeriodeController::class, 'store'])->name('store');
  Route::post('/activate', [BukaPeriodeController::class, 'activate'])->name('activate');
  Route::get('/edit/{id}', [BukaPeriodeController::class, 'edit'])->name('edit');
  Route::delete('/{id}', [BukaPeriodeController::class, 'destroy'])->name('destroy');
});

Route::get('/email', [EmailController::class, 'sendEmail']);
