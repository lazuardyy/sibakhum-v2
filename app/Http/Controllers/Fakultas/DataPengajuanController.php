<?php

namespace App\Http\Controllers\Fakultas;

use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;
use App\Models\HistoryPengajuan;

class DataPengajuanController extends Controller
{
  public function index ()
  {
    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    $unit   = session('user_unit');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode !== '3') {
      return redirect()->to('/home');
    }

    $pengajuan_cuti = PengajuanCuti::where('kode_fakultas', trim($unit))->get();
    $pengajuan_md   = PengunduranDiri::where('kode_fakultas', trim($unit))->get();
    // dd($pengajuan_md);

    $arrData = [
      'title'               => 'Semua Data Pengajuan',
      'subtitle'            => 'Semua Data Pengajuan',
      'modal_title'         => 'Detail Pengajuan',
      'active'              => 'Home',
      'all_data_active'     => 'active',

      'pengajuan_cuti'      => $pengajuan_cuti,
      'pengajuan_md'        => $pengajuan_md,
    ];

    // dd($arrData);

    return view('verifikasi.all', $arrData);
  }
}
