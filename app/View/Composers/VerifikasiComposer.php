<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;

class VerifikasiComposer
{
  public function compose(View $view)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    $unit   = session('user_unit');
    // dd($unit);
    // dd($cmode);

    if($cmode == config('constants.users.dosen')) {
      $pengajuan_cuti = PengajuanCuti::where('pa', session('user_username'))
      ->where('status_pengajuan', '>=','0')
      ->get();

      // dd($pengajuan_cuti);
      $pengunduran_diri = PengunduranDiri::where('pa', session('user_username'))
      ->where('status_pengajuan', '>=', '0')
      ->get();

      $all_pengajuan = '';
    }
    elseif($cmode == config('constants.users.prodi')) {
      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', trim($unit))
      ->where('status_pengajuan', '>=', '1')
      ->where('status_pengajuan', '!=', '21')
      ->get();
      // dd($pengajuan_cuti);

      $pengunduran_diri = PengunduranDiri::where('kode_prodi',trim($unit))
      ->where('status_pengajuan', '>=', '1')
      ->where('status_pengajuan', '!=', '21')
      ->get();

      $all_pengajuan = '';
    }
    elseif($cmode == config('constants.users.dekanat')) {
      // dd($cmode);
      $pengajuan_cuti   = PengajuanCuti::where('kode_fakultas', 'like', trim($unit))
      ->where('status_pengajuan', '>=', '2')
      ->where('status_pengajuan', '!=', '22')
      ->get();
      // dd($pengajuan_cuti);

      $pengunduran_diri = PengunduranDiri::where('kode_fakultas', 'like', trim($unit))
      ->where('status_pengajuan', '>=', '2')
      ->where('status_pengajuan', '!=', '22')
      ->get();

    }
    // elseif($cmode == config('constants.users.rektorat'))
    // {

    // }
    else {
      $pengajuan_cuti   = PengajuanCuti::where('kode_fakultas', 'like', trim($unit))
      ->where('status_pengajuan', '>=', '4')
      ->where('status_pengajuan', '!=', '21')
      ->where('status_pengajuan', '!=', '22')
      ->where('status_pengajuan', '!=', '23')
      ->where('status_pengajuan', '!=', '24')
      ->get();
      // dd($pengajuan_cuti);

      $pengunduran_diri = PengunduranDiri::where('kode_fakultas', 'like', trim($unit))
      ->where('status_pengajuan', '>=', '4')
      ->where('status_pengajuan', '!=', '21')
      ->where('status_pengajuan', '!=', '22')
      ->where('status_pengajuan', '!=', '23')
      ->where('status_pengajuan', '!=', '24')
      ->get();

      $kode_prodi = '';
      $nama_prodi = '';
    }

    $all_pengajuan = $pengajuan_cuti->merge($pengunduran_diri);
    // dd($all_pengajuan);

    $arrData = [
      'pengajuan_cuti'    => $pengajuan_cuti,
      'pengunduran_diri'  => $pengunduran_diri,
      'all_pengajuan'     => $all_pengajuan,
    ];

    $view->with('verifikasi', $arrData);
  }
}
