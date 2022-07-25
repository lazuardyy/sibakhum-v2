<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanMhs;
use App\Models\HistoryPengajuan;
use App\Models\BukaPeriode;
use PDF;

class SuratMasukController extends Controller
{
  public function surat_masuk ()
  {

    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    $unit   = session('user_unit');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode === config('constants.users.mahasiswa')) {
      return redirect()->to('/home');
    }

    $pengajuan_mhs = PengajuanMhs::where('kode_fakultas', trim($unit))
    ->whereIn('status_pengajuan', [7])
    ->get();

    $arrData = [
      'title'               => 'Surat Masuk',
      'subtitle'            => 'Surat Masuk',
      'active'              => 'Home',
      'surat_active'        => 'active',

      'pengajuan_mhs'       => $pengajuan_mhs
    ];


    return view('fakultas.surat', $arrData);
  }

  public function download_sk ($id)
  {
    $pengajuan_mhs = PengajuanMhs::findOrFail($id);
    $pengajuan_mhs = json_decode($pengajuan_mhs);
    // dd($pengajuan_mhs);

    $history = HistoryPengajuan::where('id_pengajuan', $pengajuan_mhs->id)
    ->where('status_pengajuan', 4)
    ->get();
    $history = json_decode($history);
    // dd($history);

    $periode = BukaPeriode::where('aktif', '1')->first();
    $periode = json_decode($periode);
    // dd($periode);


    $pdf = PDF::loadView('bakhum.pdf', [
      'pengajuan' => $pengajuan_mhs,
      'history'   => $history,
      'periode'   => $periode,
    ]);

    $file_name = $pengajuan_mhs->nama . '_' . $pengajuan_mhs->nim . '_' . (($pengajuan_mhs->jenis_pengajuan == 1) ? 'Surat Keterangan Cuti' : 'Surat Keterangan Pengunduran Diri');
    // dd($file_name);
    // return $pdf->download('surat.pdf');
    return $pdf->download($file_name);
  }
}
