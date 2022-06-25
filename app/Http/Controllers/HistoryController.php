<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\HistoryPengajuan;
use App\Models\PengajuanMhs;
use App\Models\PengunduranDiri;

class HistoryController extends Controller
{
  public function index ()
  {
    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    // dd($cmode);

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

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

      $prodi = env('APP_ENDPOINT_PRODI') . $kode_prodi;
      $responsePr = Http::get($prodi);
      $dataProdi = json_decode($responsePr);

      if ($dataProdi->status == true) {
        foreach ($dataProdi->isi as $prodi)
        {
          $nama_prodi = $prodi->namaProdi;
        }
      }

    }
    elseif($cmode === config('constants.users.prodi')) {
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
    }
    // elseif($cmode === '14') {

    // }
    else {
      $kode_prodi = '';
    }

    if($cmode === config('constants.users.dosen') || $cmode === config('constants.users.prodi')) {
      $history_cuti = PengajuanMhs::where('kode_prodi', $kode_prodi)
      ->where('jenis_pengajuan', 1)
      ->pluck('id')
      ->toArray();

      // dd($history_cuti);

      foreach($history_cuti as $history){
        $id = $history;

        $history_cuti = HistoryPengajuan::where('id_pengajuan', $id)
        ->where('status_pengajuan', '>', 0)
        ->get();
      }

      // dd($history_cuti);

      $history_md = PengajuanMhs::where('kode_prodi', $kode_prodi)
      ->where('jenis_pengajuan', 2)
      ->value('id');

      $history_md = HistoryPengajuan::where('id_pengajuan', $history_md)
      ->where('status_pengajuan', '>', 0)
      ->get();
    }
    else {
      $history_cuti = PengajuanMhs::where('kode_fakultas', trim(session('user_unit')))
      ->where('jenis_pengajuan', 1)
      ->value('id');

      $history_cuti = HistoryPengajuan::where('id_pengajuan', $history_cuti)
      ->where('status_pengajuan', '>', 0)
      ->get();

      $history_md = PengajuanMhs::where('kode_fakultas', trim(session('user_unit')))
      ->where('jenis_pengajuan', 2)
      ->value('id');

      $history_md = HistoryPengajuan::where('id_pengajuan', $history_md)
      ->where('status_pengajuan', '>', 0)
      ->get();
      // dd($history_cuti);

    }

    foreach($history_cuti as $history){
      $id_cuti_history = $history->id_pengajuan;
      // dd($id_cuti_history);
    }

    foreach($history_md as $history){
      $id_md_history = $history->id_pengajuan;
    }

    $arrData = [
      'title'           => 'Riwayat Persetujuan',
      'subtitle'        => 'Riwayat Persetujuan',
      'active'          => 'Home',
      'riwayat_active'  => 'active',

      'history_cuti'    => $history_cuti,
      'history_md'      => $history_md,
      'id_cuti_history' => isset($id_cuti_history),
      'id_md_history'   => isset($id_md_history),

    ];
    return view('histories', $arrData);
  }
}
