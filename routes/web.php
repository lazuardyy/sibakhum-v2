<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Mahasiswa\PengajuanMhsController;
use App\Http\Controllers\Fakultas\PengunduranDiriController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Fakultas\VerifikasiController;
use App\Http\Controllers\Fakultas\PersuratanFakultasController;
use App\Http\Controllers\Bakhum\BakhumController;
use App\Http\Controllers\Bakhum\BukaPeriodeController;
use App\Http\Controllers\Bakhum\PersuratanBakhumController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Email\EmailController;
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


Route::group(['prefix' => 'pengajuan-mhs', 'as' => 'pengajuan-mhs.'], function () {
  Route::get('/create', [PengajuanMhsController::class, 'create'])->name('create');
  Route::get('/create-md', [PengunduranDiriController::class, 'create'])->name('create-md');
  Route::post('/store', [PengajuanMhsController::class, 'store'])->name('store');
  Route::get('/{id}/edit', [PengajuanMhsController::class, 'edit'])->name('edit');
  Route::get('/status/{nim}', [PengajuanMhsController::class, 'show'])->name('show');
  Route::put('/{id}', [PengajuanMhsController::class, 'update'])->name('update');
  Route::delete('/{id}', [PengajuanMhsController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'data-pengajuan-mhs', 'as' => 'data-mhs.'], function () {
  Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('index');
  Route::get('/', [BakhumController::class, 'index'])->name('semua');
  // Route::get('/{filter}', [BakhumController::class, 'filter'])->name('filter');
  Route::get('/cetak/{mhs}', [BakhumController::class, 'download'])->name('cetak');
  Route::get('/ubah-status-tagihan', [BakhumController::class, 'ubahStatusTagihan'])->name('ubah-tagihan');
  Route::get('/{jenis_pengajuan}', [DosenController::class, 'show'])->name('show');
  Route::get('/detail/{nim}', [DosenController::class, 'detailMhs'])->name('detailMhs');
  Route::post('/verifikasi-dosen', [DosenController::class, 'verifikasiDosen'])->name('verifikasi-dosen');
  Route::post('/verifikasi-bakhum', [BakhumController::class, 'verifikasiBakhum'])->name('verifikasi-bakhum');
  Route::post('/verifikasi', [VerifikasiController::class, 'verifikasi'])->name('verifikasi');
});

Route::group(['prefix' => 'persuratan', 'as' => 'surat.'], function () {
  Route::get('/surat-keterangan', [PersuratanFakultasController::class, 'surat_masuk_bakhum'])->name('bakhum');
  Route::get('/permohonan-pengunduran-diri/{pengajuan}', [PersuratanFakultasController::class, 'surat_masuk_prodi'])->name('prodi');
  Route::get('/download-sk/{id}', [PersuratanFakultasController::class, 'download_sk'])->name('download_sk');
  Route::get('/kirim-surat', [PersuratanBakhumController::class, 'index_surat'])->name('index_surat');
  Route::post('/kirim-sk', [PersuratanBakhumController::class, 'upload_sk'])->name('upload_sk');
  Route::post('/kirim-permohonan', [PersuratanFakultasController::class, 'kirim_permohonan'])->name('kirim_permohonan');
});

Route::group(['prefix' => 'informasi', 'as' => 'informasi.'], function () {
  Route::get('riwayat-persetujuan', [HistoryController::class, 'index'])->name('persetujuan');
  Route::get('data-grafik', [HistoryController::class, 'data_grafik'])->name('grafik');
});


Route::group(['prefix' => 'periode', 'as' => 'periode.'], function () {
  Route::get('/buka-periode', [BukaPeriodeController::class, 'index'])->name('index');
  Route::post('/store', [BukaPeriodeController::class, 'store'])->name('store');
  Route::post('/activate', [BukaPeriodeController::class, 'activate'])->name('activate');
  Route::get('/edit/{id}', [BukaPeriodeController::class, 'edit'])->name('edit');
  Route::delete('/{id}', [BukaPeriodeController::class, 'destroy'])->name('destroy');
});

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    // dd($response);

    return $response;
})->name('file_pengajuan.show');
