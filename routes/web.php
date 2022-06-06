<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/attemptLogin', [LoginController::class, 'attemptLogin'])->name('login.attemptLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');
// Route::post('/logout', [LoginController::class, 'logout']);


// Route::get('/', [StudentController::class, 'index']);
Route::get('/home', [StudentController::class, 'index'])->name('home');

// Route::post('/', [LoginController::class, 'redirectTo']);

// login redirect to home
Auth::routes();
// Route::get('home', [DashboardController::class, 'index'])->name('home');

// mahasiswa routes
// Route::get('test', [StudentController::class, 'index']);
Route::get('mahasiswa/status-pengajuan', [StudentController::class, 'status']);

// dosen routes
Route::prefix('home')->group(function () {
  Route::get('/{user:nidn}', [LecturerController::class, 'show'])
  // ->middleware('can:isDosen')
  ->name('dosen');
});

// dashboard routes
Route::get('data-grafik/fakultas', [DashboardController::class, 'fakultas']) -> middleware('can:isSuperAdminAdmin');
Route::get('data-grafik/universitas', [DashboardController::class, 'universitas']) -> middleware('can:isSuperAdminAdmin');

// superadmin routes
// Route::get('/data-user', [UserController::class, 'user'])->name('data');
Route::get('superadmin', [UserController::class, 'index'])->middleware('can:isSuperAdmin');
Route::resource('superadmin', UserController::class);

// mahasiswa routes
Route::resource('mahasiswa/cuti', StudentController::class);
Route::resource('mahasiswa/md', MDStudentController::class);
Route::resource('dosen/persetujuan', DetailCutiMhsController::class);

// test
// Route::get('fakultas/{$id}', [FacultyController::class,'show']);
Route::resource('faculty', FacultyController::class);
// Route::get('faculty/{faculty:name}', [FacultyController::class,'show'])->middleware('can:isFakultas');


// Route::get('/welcome', function(){
//   $data = Http::get('http://103.8.12.212:36880/siakad_api/api/as400/fakultas/All');
//   $datas = json_encode($data['isi']);
//   $final = json_decode($datas);
//   return view('test', [
//     'datas' => $final,
//     'data' => $data,
//   ]);
// });
