<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
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
      $history_cuti = PengajuanMhs::where(($cmode === config('constants.users.dosen') ? 'pa' : 'kode_prodi'), ($cmode === config('constants.users.dosen') ? session('user_username') : trim(session('user_unit'))))
      ->where('jenis_pengajuan', 1)
      ->pluck('id');

      $history_md = PengajuanMhs::where(($cmode === config('constants.users.dosen') ? 'pa' : 'kode_prodi'), ($cmode === config('constants.users.dosen') ? session('user_username') : trim(session('user_unit'))))
      ->where('jenis_pengajuan', 2)
      ->pluck('id');

      $all_history = $history_cuti->merge($history_md);

      $histories = array();

      for($i = 0; $i < count($all_history); $i++ ) {
        $histories_[$i] = HistoryPengajuan::where('id_pengajuan', $all_history[$i])
        ->whereIn('status_pengajuan', ($cmode === config('constants.users.dosen') ? [1, 21] : [2, 22]))
        ->get();

        $histories[] = $histories_[$i];
      }
    }
    elseif($cmode === config('constants.users.fakultas') || $cmode === config('constants.users.dekanat')) {
      $history_cuti = PengajuanMhs::where('kode_fakultas', trim(session('user_unit')))
      ->where('jenis_pengajuan', 1)
      ->pluck('id');
      // ->toArray();

      // dump($history_cuti);

      $history_md = PengajuanMhs::where('kode_fakultas', trim(session('user_unit')))
      ->where('jenis_pengajuan', 2)
      ->pluck('id');
      // ->toArray();

      $all_history = $history_cuti->merge($history_md);
      // dump($all_history);

      $histories = array();

      for($i = 0; $i < count($all_history); $i++ ) {
        $histories_[$i] = HistoryPengajuan::where('id_pengajuan', $all_history[$i])
        ->whereIn('status_pengajuan', (($cmode == config('constants.users.fakultas')) ? [3] : [4, 23]))
        ->get();

        $histories[] = $histories_[$i];
      }
    }
    else {
      $history_cuti = PengajuanMhs::where('jenis_pengajuan', 1)
      ->pluck('id');
      // ->toArray();

      // dump($history_cuti);

      $history_md = PengajuanMhs::where('jenis_pengajuan', 2)
      ->pluck('id');
      // ->toArray();

      $all_history = $history_cuti->merge($history_md);
      // dump($all_history);

      $histories = array();

      for($i = 0; $i < count($all_history); $i++ ) {
        $histories_[$i] = HistoryPengajuan::where('id_pengajuan', $all_history[$i])
        ->whereIn('status_pengajuan', (($cmode == config('constants.users.wakil_rektor')) ? [5, 24] : [6]))
        ->get();

        $histories[] = $histories_[$i];
      }
    }

    $arrData = [
      'title'           => 'Riwayat Persetujuan',
      'subtitle'        => 'Riwayat Persetujuan',
      'active'          => 'Home',
      'riwayat_active'  => 'active',

      // 'history_cuti'    => $history_cuti,
      'histories'       => $histories,
      // 'nama_mhs'        => $nama_mhs,
      // 'jenis_pengajuan' => $jenis_pengajuan,
      // 'created_at'      => $created_at,
      'all_history'     => $all_history,
      // 'id_cuti_history' => isset($id_cuti_history),
      // 'id_md_history'   => isset($id_md_history),

    ];
    return view('histories', $arrData);
  }
}
