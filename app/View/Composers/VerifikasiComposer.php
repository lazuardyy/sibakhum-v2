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
  public $pengajuanMhs;

  public function __construct(Request $request, PengajuanMhs $pengajuanMhs)
  {
    $this->jenis_pengajuan  = $request->jenis_pengajuan;
    $this->$pengajuanMhs    = $pengajuanMhs;
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
    // elseif($cmode == config('constants.users.dosen') && $cmode == config('constants.users.mahasiswa')) {
    //   return redirect()->to('/home');
    // }
    if($cmode == config('constants.users.dosen')) {
      // dd($this->jenis_pengajuan);
      $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($this->jenis_pengajuan == 'cuti') ? 1 : 2)
      ->where('pa', session('user_username'))
      ->whereIn('status_pengajuan', [0, 1, 21])
      ->get();

      // dd($pengajuan_mhs);
    }
    elseif($cmode == config('constants.users.prodi')) {
      $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($this->jenis_pengajuan == 'cuti') ? 1 : 2)
      ->where('kode_prodi', trim($unit))
      ->whereIn('status_pengajuan', [1, 2, 22])
      ->get();
    }

    elseif($cmode == config('constants.users.dekanat') || $cmode == config('constants.users.wakil_rektor')) {
      $dekanat  = [3, 23];
      $rektorat = [4, 24];

      if(isset($this->jenis_pengajuan) && $this->jenis_pengajuan != 'semua') {
        $this->jenis_pengajuan == 'cuti' ? $jenis_pengajuan = 1 : $jenis_pengajuan = 2;

        $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', ($cmode == config('constants.users.dekanat') ? $dekanat : $rektorat))
        ->where('jenis_pengajuan', $jenis_pengajuan)
        ->get();
      }
      else {
        $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', ($cmode == config('constants.users.dekanat') ? $dekanat : $rektorat))
        ->get();
      }
    }
    elseif($cmode == config('constants.users.fakultas')) {
      if(isset($this->jenis_pengajuan) && $this->jenis_pengajuan != 'semua') {
        $this->jenis_pengajuan == 'cuti' ? $jenis_pengajuan = 1 : $jenis_pengajuan = 2;

        $pengajuan_mhs = PengajuanMhs::with('refSurat', 'refFilePengajuan')->whereIn('status_pengajuan', [2])
        ->where('jenis_pengajuan', $jenis_pengajuan)
        ->get();
      }
      else {
        $pengajuan_mhs = PengajuanMhs::where('kode_fakultas', trim($unit))
        ->whereIn('status_pengajuan', [2])
        ->get();
      }
    }
    elseif($cmode == config('constants.users.bakhum')) {

      if(isset($this->jenis_pengajuan) && $this->jenis_pengajuan != 'semua') {
        $this->jenis_pengajuan == 'cuti' ? $jenis_pengajuan = 1 : $jenis_pengajuan = 2;

        $pengajuan_mhs = PengajuanMhs::with('refSurat', 'refFilePengajuan')->whereIn('status_pengajuan', [5, 6, 7])
        ->where('jenis_pengajuan', $jenis_pengajuan)
        ->get();
      }
      else {
        $pengajuan_mhs = PengajuanMhs::with('refSurat', 'refFilePengajuan')->whereIn('status_pengajuan', [5, 6, 7])
        ->get();
      }

    }
    else {
      $pengajuan_mhs = null;
    }

    $arrData = [
      'pengajuan_mhs'     => $pengajuan_mhs
    ];

    $view->with('verifikasi', $arrData);
  }
}
