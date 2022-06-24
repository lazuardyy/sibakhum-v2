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

    if($cmode === config('constants.users.dosen') || $cmode == config('constants.users.prodi')) {
      $url = env('APP_ENDPOINT_DSN') . session('user_username') . '/' . session('user_token');
      $response = Http::get($url);
      $data = json_decode($response);

      if ($data->status == true) {
        foreach ($data->isi as $dsn)
        {
          $kode_prodi = $dsn->prodi;
        }
      }

      $history_cuti = PengajuanMhs::where('kode_prodi', ($cmode == config('constants.users.dosen') ? $kode_prodi : trim(session('user_unit'))))
      ->where('jenis_pengajuan', '<=', 2)
      ->value('id');

      $history_cuti = HistoryPengajuan::where('id_pengajuan', $history_cuti)
      ->where('status_pengajuan', '>', 0)
      ->get();
    }
    else{
      $history_cuti = PengajuanMhs::where('kode_fakultas', trim(session('user_unit')))
      ->value('id');

      $history_cuti = HistoryPengajuan::where('id_pengajuan', $history_cuti)
      ->where('status_pengajuan', '>', 0)
      ->get();
    }

    foreach($history_cuti as $history){
      $id_cuti_history = $history->id_pengajuan;
    }

    // foreach($history_md as $history){
    //   $id_md_history = $history->id_pengajuan;
    // }

    $arrData = [
      'title'           => 'Riwayat Persetujuan',
      'subtitle'        => 'Riwayat Persetujuan',
      'active'          => 'Home',
      'riwayat_active'  => 'active',

      'history_cuti'    => $history_cuti,
      // 'history_md'      => $history_md,
      'id_cuti_history' => isset($id_cuti_history),
      // 'id_md_history'   => isset($id_md_history),

    ];
    return view('histories', $arrData);
  }
}
