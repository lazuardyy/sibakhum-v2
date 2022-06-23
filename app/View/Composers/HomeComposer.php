<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;

class HomeComposer
{
  public function compose(View $view)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');
    // dd($cmode);

    if($cmode === config('constants.users.dosen')) {
      $url = env('APP_ENDPOINT_DSN') . session('user_username') . '/' . session('user_token');
      $response = Http::get($url);
      $data = json_decode($response);

      if ($data->status == true) {
        foreach ($data->isi as $dsn)
        {
          $kode_prodi = $dsn->prodi;
        }
      }

      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', $kode_prodi)
      ->where('status_pengajuan', '0')
      ->get();

      $pengunduran_diri = PengunduranDiri::where('kode_prodi', $kode_prodi)
      ->where('status_pengajuan', '0')
      ->get();

      $cuti = $pengajuan_cuti->count('id');
      $md   = $pengunduran_diri->count('id');
      // dd($md);

      $pengajuan = compact('cuti', 'md');

      // dd($pengajuan->count());
    }
    elseif($cmode === config('constants.users.prodi')) {
      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', session('user_unit'))
      ->where('status_pengajuan', '1')
      ->get();

      $pengunduran_diri = PengunduranDiri::where('kode_prodi', session('user_unit'))
      ->where('status_pengajuan', '1')
      ->get();

      $cuti = $pengajuan_cuti->count('id');
      $md   = $pengunduran_diri->count('id');
      // dd($md);

      $pengajuan = compact('cuti', 'md');

      // dd($pengajuan);
    }
    elseif($cmode === config('constants.users.dekanat') || $cmode === config('constants.users.fakultas')) {
      $pengajuan_cuti = PengajuanCuti::where('kode_fakultas', session('user_unit'))
      ->where('status_pengajuan', ($cmode === config('constants.users.dekanat')) ? '2' : '4')
      ->get();

      $pengunduran_diri = PengunduranDiri::where('kode_fakultas', session('user_unit'))
      ->where('status_pengajuan', ($cmode === config('constants.users.dekanat')) ? '2' : '4')
      ->get();

      $cuti = $pengajuan_cuti->count('id');
      $md   = $pengunduran_diri->count('id');

      $pengajuan = compact('cuti', 'md');
    }
    else {
      $cuti = '';
      $md   = '';

      $pengajuan = compact('cuti', 'md');
    }

    $home = compact('user', 'mode', 'cmode', 'pengajuan');
  // dd($home);

    $view->with('home', $home);
  }
}
