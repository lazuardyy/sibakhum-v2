<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\HistoryPengajuan;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;

class HistoryController extends Controller
{
  public function index ()
  {
    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

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

      $prodi = env('APP_ENDPOINT_PRODI') . $kode_prodi;
      $responsePr = Http::get($prodi);
      $dataProdi = json_decode($responsePr);

      if ($dataProdi->status == true) {
        foreach ($dataProdi->isi as $prodi)
        {
          $nama_prodi = $prodi->namaProdi;
        }
      }

      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', 'like', $kode_prodi)
      ->where('status_pengajuan','0')
      ->orWhere('status_pengajuan','21')
      ->get();

      $pengunduran_diri = PengunduranDiri::where('kode_prodi', $kode_prodi)
      ->where('status_pengajuan', '0')
      ->get();

      $count_cuti = $pengajuan_cuti->count('id');
      $count_md   = $pengunduran_diri->count('id');

    }
    elseif($cmode === '2') {
      $url = env('APP_ENDPOINT_PRODI') . session('user_unit');
      $response = Http::get($url);
      $data = json_decode($response);

      if ($data->status == true) {
        foreach ($data->isi as $prodi)
        {
          $nama_prodi = $prodi->namaProdi;
          $kode_prodi = $prodi->kodeProdi;
        }
      }

      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', 'like', $kode_prodi)
      ->where('status_pengajuan', '1')
      ->orWhere('status_pengajuan','22')
      ->get();

      $pengunduran_diri = PengunduranDiri::where('kode_prodi', $kode_prodi)
      ->where('status_pengajuan', '0')
      ->get();

      $count_cuti = $pengajuan_cuti->count('id');
      $count_md   = $pengunduran_diri->count('id');
    }

    $history_cuti = PengajuanCuti::where('kode_prodi', $kode_prodi)
    ->where('status_pengajuan', '>=', '1')
    ->orWhere('status_pengajuan', '21')
    ->get();

    // dd($history_cuti);

    $arrData = [
      'title'           => 'Riwayat Persetujuan',
      'subtitle'        => 'Riwayat Persetujuan',
      'active'          => 'Home',
      'user'            => $user,
      'mode'            => $mode,
      'cmode'           => $cmode,
      'riwayat_active'  => 'active',
      'histories'       => HistoryPengajuan::where('v_mode', $cmode)->get(),
      'history_cuti'    => $history_cuti,
      'count_cuti'      => $count_cuti,
      'count_md'        => $count_md,
    ];
    return view('histories', $arrData);
  }
}
