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

    if($cmode === config('constants.users.dosen') || $cmode === config('constants.users.prodi')) {
      $history_cuti = PengajuanMhs::where('pa', session('user_username'))
      ->where('jenis_pengajuan', 1)
      ->pluck('id')
      ->toArray();

      $histories = HistoryPengajuan::where('id_pengajuan', $history_cuti)
      ->where('status_pengajuan', '>', 0)
      ->get();
    }
    else {
      $history_cuti = PengajuanMhs::where((($cmode == config('constants.users.prodi')) ? 'kode_prodi' : 'kode_fakultas'), trim(session('user_unit')))
      ->where('jenis_pengajuan', 1)
      ->pluck('id')
      ->toArray();

      // dd($history_cuti);

      $histories = HistoryPengajuan::where('id_pengajuan', $history_cuti)
      ->where('status_pengajuan', '>', 0)
      ->get();

      $history_md = PengajuanMhs::where('kode_fakultas', trim(session('user_unit')))
      ->where('jenis_pengajuan', 2)
      ->get('id');
    }

    foreach($histories as $history) {
      $created_at      = $history->created_at;
      $nama_mhs        = $history->pengajuanMhs->nama;
      $jenis_pengajuan = $history->jenis_pengajuan;
    }


    if($histories == '[]') {
      $created_at      = null;
      $nama_mhs        = null;
      $jenis_pengajuan = null;
    }


    $arrData = [
      'title'           => 'Riwayat Persetujuan',
      'subtitle'        => 'Riwayat Persetujuan',
      'active'          => 'Home',
      'riwayat_active'  => 'active',

      'history_cuti'    => $history_cuti,
      'histories'       => $histories,
      'nama_mhs'        => $nama_mhs,
      'jenis_pengajuan' => $jenis_pengajuan,
      'created_at'      => $created_at,
      // 'id_cuti_history' => isset($id_cuti_history),
      // 'id_md_history'   => isset($id_md_history),

    ];
    return view('histories', $arrData);
  }
}
