<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanMhs;
use App\Models\PengunduranDiri;
use Illuminate\Database\Eloquent\Builder;

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
    $unit = trim(session('user_unit'));
    // dd($cmode);

    if($cmode === config('constants.users.dosen')) {
      // $url = env('APP_ENDPOINT_DSN') . session('user_username') . '/' . session('user_token');
      // $response = Http::get($url);
      // $data = json_decode($response);

      // if ($data->status == true) {
      //   foreach ($data->isi as $dsn)
      //   {
      //     $kode_prodi = $dsn->prodi;
      //   }
      // }

      $pengajuan_cuti = PengajuanMhs::where('pa', session('user_username'))
      ->where('status_pengajuan', '0')
      ->where('jenis_pengajuan', '1')
      ->count();

      // dd($pengajuan_cuti);

      $pengunduran_diri = PengajuanMhs::where('pa', session('user_username'))
      ->where('status_pengajuan', '0')
      ->where('jenis_pengajuan', '2')
      ->count();
      // dd($md);

      // $pengajuan = compact('cuti', 'md');

      // dd($pengajuan->count());
    }
    elseif($cmode === config('constants.users.prodi')) {
      $pengajuan_cuti = PengajuanMhs::where('kode_prodi', session('user_unit'))
      ->where('status_pengajuan', '1')
      ->where('jenis_pengajuan', '1')
      ->count();

      $pengunduran_diri = PengajuanMhs::where('kode_prodi', session('user_unit'))
      ->where('status_pengajuan', '1')
      ->where('jenis_pengajuan', '2')
      ->count();
      // dd($md);

      // $pengajuan = compact('cuti', 'md');

      // dd($pengajuan);
    }
    elseif($cmode === config('constants.users.dekanat') || $cmode === config('constants.users.fakultas')) {
      $pengajuan_cuti = PengajuanMhs::where('kode_fakultas', trim(session('user_unit')))
      ->where('status_pengajuan', ($cmode === config('constants.users.dekanat')) ? '3' : '2')
      ->where('jenis_pengajuan', '1')
      ->count();

      $pengunduran_diri = PengajuanMhs::where('kode_fakultas', trim(session('user_unit')))
      ->where('status_pengajuan', ($cmode === config('constants.users.dekanat')) ? '3' : '2')
      ->where('jenis_pengajuan', '2')
      ->count();

      // $pengajuan = compact('cuti', 'md');
    }
    elseif($cmode == config('constants.users.bakhum') || $cmode == config('constants.users.wakil_rektor')) {
      $pengajuan_cuti = PengajuanMhs::where('status_pengajuan',  (($cmode == config('constants.users.bakhum')) ? '5' : '4'))
      ->where('jenis_pengajuan', '1')
      ->count();

      $pengunduran_diri = PengajuanMhs::where('status_pengajuan',  (($cmode == config('constants.users.bakhum')) ? '5' : '4'))
      ->where('jenis_pengajuan', '2')
      ->count();

      // $pengajuan = compact('cuti', 'md');
    }
    else {
      $cuti = '';
      $md   = '';
      $pengajuan = '';

      // $pengajuan = compact('cuti', 'md');
    }

    if($cmode != config('constants.users.mahasiswa')) {
      $cuti = $pengajuan_cuti;
      $md   = $pengunduran_diri;
      $pengajuan = compact('cuti', 'md');
    }
    $home = compact('user', 'mode', 'cmode', 'unit', 'pengajuan');
    // dd($home);

    $view->with('home', $home);
  }
}
