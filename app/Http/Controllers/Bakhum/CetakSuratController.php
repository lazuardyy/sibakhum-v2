<?php

namespace App\Http\Controllers\Bakhum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanMhs;
use PDF;

class CetakSuratController extends Controller
{
  public function index ()
  {
    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    $unit   = session('user_unit');

    if(!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode == config('constants.users.dosen') && $cmode == config('constants.users.mahasiswa')) {
      return redirect()->to('/home');
    }


    $pengajuan_mhs = PengajuanMhs::where('status_pengajuan', '>=', 5)
    ->where('status_pengajuan', '!=', '21')
    ->where('status_pengajuan', '!=', '22')
    ->where('status_pengajuan', '!=', '23')
    ->get();

    // $pengajuan_md   = PengunduranDiri::where('kode_fakultas', trim($unit))->get();
    // dd($pengajuan_md);

    $arrData = [
      'title'               => 'Semua Data Pengajuan',
      'subtitle'            => 'Semua Data Pengajuan',
      'modal_title'         => 'Detail Pengajuan',
      'active'              => 'Home',
      'all_data_active'     => 'active',

      'pengajuan_mhs'       => $pengajuan_mhs,
      // 'pengajuan_md'        => $pengajuan_md,
    ];

    // dd($arrData);

    return view('bakhum.cetak_surat', $arrData);
  }

  public function download ($id)
  {
    $pengajuan_mhs = PengajuanMhs::findOrFail($id)->get();
    $pengajuan_mhs = json_decode($pengajuan_mhs)[0];
    // dd(json_decode($pengajuan_mhs)[0]);

    $pdf = PDF::loadView('bakhum.pdf', [
      'pengajuan' => $pengajuan_mhs
    ]);
    // return $pdf->download('surat.pdf');
    return $pdf->stream();
  }
}
