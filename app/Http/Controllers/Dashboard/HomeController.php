<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;

class HomeController extends Controller
{
  public function index ()
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    if($cmode === '8') {
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

      $count_cuti = $pengajuan_cuti->count('id');
      $count_md   = $pengunduran_diri->count('id');

    }
    elseif($cmode === '2') {
      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', session('user_unit'))
      ->where('status_pengajuan', '1')
      ->get();

      $pengunduran_diri = PengunduranDiri::where('kode_prodi', session('user_unit'))
      ->where('status_pengajuan', '1')
      ->get();

      $count_cuti = $pengajuan_cuti->count('id');
      $count_md   = $pengunduran_diri->count('id');
    }
    else {
      $count_cuti = '';
      $count_md   = '';
    }

    $arrData = [
      'title'             => 'Dashboard',
      'active'            => 'Home',
      'user'              => $user,
      'mode'              => $mode,
      'cmode'             => $cmode,
      'home_active'       => 'active',
      'count_cuti'        => $count_cuti,
      'count_md'          => $count_md,
    ];

    // $cuti = collect(PengajuanCuti::where('kode_prodi', 'like', trim(session('user_unit')) . '%')->get());

    // $md = collect(PengunduranDiri::where('kode_prodi', 'like', trim(session('user_unit')) . '%')->get());

    // dd($md);

    return view('home.index', $arrData);

  }
}
