<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengajuanApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'data-pengajuan', 'as' => 'pengajuan.'], function () {
  Route::get('/fakultas/{kodefakultas}', [PengajuanApiController::class, 'dataPengajuanFakultas'])->name('fakultas');
  Route::get('/mhs/{nim}', [PengajuanApiController::class, 'pengajuan_mahasiswa'])->name('mhs');
  // Route::post('/store', [PengajuanApiController::class, 'store'])->name('store');
  // Route::post('/activate', [PengajuanApiController::class, 'activate'])->name('activate');
  // Route::get('/edit/{id}', [PengajuanApiController::class, 'edit'])->name('edit');
  // Route::delete('/{id}', [PengajuanApiController::class, 'destroy'])->name('destroy');
});
