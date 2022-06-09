<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetailCutiMhsController;
use App\Http\Controllers\Mahasiswa\PengajuanCutiController;
use App\Http\Controllers\Mahasiswa\PengunduranDiriController;
use App\Http\Controllers\Dosen\VerifikasiController;
use App\Http\Controllers\FacultyController;
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
  Route::delete('/{id}', [PengajuanCutiController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'data-pengajuan', 'as' => 'data-pengajuan.'], function () {
  Route::get('/cuti', [VerifikasiController::class, 'index'])->name('index');
  Route::get('/create', [VerifikasiController::class, 'create'])->name('create');
  Route::post('/store', [VerifikasiController::class, 'store'])->name('store');
  Route::get('/{id}/edit', [VerifikasiController::class, 'edit'])->name('edit');
  Route::get('/status/{nim}', [VerifikasiController::class, 'show'])->name('show');
  Route::delete('/{id}', [VerifikasiController::class, 'destroy'])->name('destroy');
});

Route::resource('pengunduran-diri', PengunduranDiriController::class);

// Route::prefix('home')->group(function () {
//   Route::get('/{user:nidn}', [LecturerController::class, 'show'])
//   ->name('dosen');
// });

// dashboard routes
// Route::get('data-grafik/fakultas', [DashboardController::class, 'fakultas']) -> middleware('can:isSuperAdminAdmin');
// Route::get('data-grafik/universitas', [DashboardController::class, 'universitas']) -> middleware('can:isSuperAdminAdmin');

// superadmin routes
// Route::get('/data-user', [UserController::class, 'user'])->name('data');
Route::get('superadmin', [UserController::class, 'index'])->middleware('can:isSuperAdmin');
Route::resource('superadmin', UserController::class);

// mahasiswa routes
// Route::resource('mahasiswa/cuti', PengajuanCutiController::class);
// Route::resource('mahasiswa/md', PengunduranDiriController::class);
Route::resource('dosen/persetujuan', DetailCutiMhsController::class);

// test
// Route::get('fakultas/{$id}', [FacultyController::class,'show']);
// Route::resource('faculty', FacultyController::class);
// Route::get('faculty/{faculty:name}', [FacultyController::class,'show']);
