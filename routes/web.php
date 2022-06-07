<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetailCutiMhsController;
use App\Http\Controllers\Mahasiswa\StudentController;
use App\Http\Controllers\Mahasiswa\MDStudentController;
use App\Http\Controllers\Dosen\LecturerController;
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
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');


Route::get('/home', [StudentController::class, 'index'])->name('home');
Route::get('mahasiswa/status-pengajuan/{student:nim}', [StudentController::class, 'status']);

// dosen routes
Route::prefix('home')->group(function () {
  Route::get('/{user:nidn}', [LecturerController::class, 'show'])
  ->name('dosen');
});

// dashboard routes
// Route::get('data-grafik/fakultas', [DashboardController::class, 'fakultas']) -> middleware('can:isSuperAdminAdmin');
// Route::get('data-grafik/universitas', [DashboardController::class, 'universitas']) -> middleware('can:isSuperAdminAdmin');

// superadmin routes
// Route::get('/data-user', [UserController::class, 'user'])->name('data');
Route::get('superadmin', [UserController::class, 'index'])->middleware('can:isSuperAdmin');
Route::resource('superadmin', UserController::class);

// mahasiswa routes
Route::resource('mahasiswa/cuti', StudentController::class);
Route::resource('mahasiswa/md', MDStudentController::class);
Route::resource('dosen/persetujuan', DetailCutiMhsController::class);

// test
Route::get('fakultas/{$id}', [FacultyController::class,'show']);
Route::resource('faculty', FacultyController::class);
Route::get('faculty/{faculty:name}', [FacultyController::class,'show'])->middleware('can:isFakultas');
