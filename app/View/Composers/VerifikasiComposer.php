<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\PengajuanMhs;

class VerifikasiComposer
{
  public $request;

  public function __construct(Request $request)
  {
    return $this->request = $request->jenis_pengajuan;
  }

  public function compose(View $view)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    $unit   = session('user_unit');
    // dd($unit);
    // dd($cmode);

    if(!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode == config('constants.users.dosen') && $cmode == config('constants.users.mahasiswa')) {
      return redirect()->to('/home');
    }

    if($cmode == config('constants.users.dekanat') || $cmode == config('constants.users.wakil_rektor')) {
      $dekanat  = [3, 23];
      $rektorat = [4, 24];

      if(isset($this->request) && $this->request != 'semua') {
        $this->request == 'cuti' ? $jenis_pengajuan = 1 : $jenis_pengajuan = 2;

        $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', ($cmode == config('constants.users.dekanat') ? $dekanat : $rektorat))
        ->where('jenis_pengajuan', $jenis_pengajuan)
        ->get();
      }
      else {
        $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', ($cmode == config('constants.users.dekanat') ? $dekanat : $rektorat))
        ->get();
      }

      // $pengajuan_mhs = PengajuanMhs::where('kode_fakultas', trim($unit))
      // ->whereIn('status_pengajuan', [3, 4, 23])
      // ->get();
    }
    // elseif($cmode == config('constants.users.wakil_rektor')) {
    //   $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', [4, 5, 6, 7, 24])
    //   ->get();
    // }
    elseif($cmode == config('constants.users.fakultas')) {
      if(isset($this->request) && $this->request != 'semua') {
        $this->request == 'cuti' ? $jenis_pengajuan = 1 : $jenis_pengajuan = 2;

        $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', [2])
        ->where('jenis_pengajuan', $jenis_pengajuan)
        ->get();
      }
      else {
        $pengajuan_mhs = PengajuanMhs::where('kode_fakultas', trim($unit))
        ->whereIn('status_pengajuan', [2])
        ->get();
      }
    }
    else {

      if(isset($this->request) && $this->request != 'semua') {
        $this->request == 'cuti' ? $jenis_pengajuan = 1 : $jenis_pengajuan = 2;

        $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', [5, 6, 7])
        ->where('jenis_pengajuan', $jenis_pengajuan)
        ->get();
      }
      else {
        $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', [5, 6, 7])
        ->get();
      }

    }

    $arrData = [
      'pengajuan_mhs'     => $pengajuan_mhs
    ];

    $view->with('verifikasi', $arrData);
  }
}
