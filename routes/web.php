<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetailCutiMhsController;
use App\Http\Controllers\Mahasiswa\StudentController;
use App\Http\Controllers\Dosen\LecturerController;
use App\Http\Controllers\FacultyController;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
// Route::post('/', [LoginController::class, 'redirectTo']);
Route::post('/logout', [LoginController::class, 'logout']);

// login redirect to home
Auth::routes();
// Route::get('home', [DashboardController::class, 'index'])->name('home');

// mahasiswa routes
Route::get('home/mahasiswa', [StudentController::class, 'index'])->middleware('can:isStudent');
Route::get('mahasiswa/status-pengajuan', [StudentController::class, 'status']) -> middleware('can:isStudent');

// dosen routes
Route::get('home/dosen', [LecturerController::class, 'index'])->middleware('can:isDosen');

// dashboard routes
Route::get('data-grafik/fakultas', [DashboardController::class, 'fakultas']) -> middleware('can:isSuperAdminAdmin');
Route::get('data-grafik/universitas', [DashboardController::class, 'universitas']) -> middleware('can:isSuperAdminAdmin');

// superadmin routes
// Route::get('/data-user', [UserController::class, 'user'])->name('data');
Route::get('home', [UserController::class, 'index'])->middleware('can:isSuperAdmin');
Route::resource('home/superadmin', UserController::class);

// cuti routes
Route::resource('mahasiswa/cuti', StudentController::class);
Route::resource('dosen/persetujuan', DetailCutiMhsController::class);

// test
// Route::get('fakultas/{$id}', [FacultyController::class,'show']);
Route::resource('faculty', FacultyController::class);
// Route::get('faculty/{faculty:name}', [FacultyController::class,'show'])->middleware('can:isFakultas');
