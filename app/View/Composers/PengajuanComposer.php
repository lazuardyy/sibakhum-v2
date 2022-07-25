<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanMhs;
use App\Models\PengunduranDiri;

class PengajuanComposer
{
  public function compose(View $view)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $url = env('APP_ENDPOINT_MHS') . session('user_username') . '/' . session('user_token');
    $response = Http::get($url);
    $dataMhs = json_decode($response);

    if ($dataMhs->status == true) {
      foreach ($dataMhs->isi as $mhs)
      {
        $nim            = $mhs->nim;
        $pa             = $mhs->pa;
        $nama_lengkap   = $mhs->nama;
        $jenis_kelamin  = $mhs->kelamin;
        $nama_prodi     = $mhs->namaProdi;
        $kode_prodi     = $mhs->kodeProdi;
        $nama_fakultas  = $mhs->namaFakultas;
        $jenjang        = $mhs->jenjangProdi;
        $angkatan       = $mhs->angkatan;
        $hp             = $mhs->hpm;
      }
    }
    else
    {
      $nim              = 'kosong';
      $pa               = 'kosong';
      $nama_lengkap     = 'kosong';
      $jenis_kelamin    = 'kosong';
      $nama_prodi       = 'kosong';
      $kode_prodi       = 'kosong';
      $nama_fakultas    = 'kosong';
      $jenjang          = 'kosong';
      $angkatan         = 'kosong';
      $hp               = 'kosong';
    }

    $kodeFakultas = substr($kode_prodi, 0, 2);
    $url = env('APP_ENDPOINT_FK') . $kodeFakultas;
    $responseFk = Http::get($url);
    $results = json_decode($responseFk);

    if ($results->status == true) {
      foreach ($results->isi as $fk)
      {
        $kode_fakultas = $fk->kodeFakultas;
      }
    }
    else
    {
      $kode_fakultas = 'kosong';
    }

    if(session('user_cmode') == config('constants.users.mahasiswa')) {
      // $id_cuti = PengajuanMhs::where('nim', session('user_username'))->pluck('id')->toArray();

      // for($i = 0; $i < count($id_cuti); $i++) {
      //   $pengajuan_cuti = PengajuanMhs::where('id', $id_cuti)
      //   ->get();
      // }

      // $pengajuan_cuti = PengajuanMhs::where('nim', session('user_username'))->get();

      $pengajuan_cuti = PengajuanMhs::where('nim', session('user_username'))
      ->where('jenis_pengajuan', 1)
      ->get();

    }
    elseif (session('user_cmode') == config('constants.users.dosen')) {
      $pengajuan_cuti = PengajuanMhs::where('pa', session('user_username'))->get();
    }
    else {
      $pengajuan_cuti = PengajuanMhs::where(((session('user_cmode') == config('constants.users.prodi')) ? 'kode_prodi' : 'kode_fakultas'), trim(session('user_unit')))->get();
    }

    foreach($pengajuan_cuti as $pengajuan){
      $cuti = $pengajuan;
    }

    if(isset($cuti)){
      $cuti;
    }
    else {
      $cuti = null;
    }

    $arrData = [
      'nim'               => $nim,
      'pa'                => $pa,
      'nama_lengkap'      => $nama_lengkap,
      'jenis_kelamin'     => $jenis_kelamin,
      'nama_prodi'        => $nama_prodi,
      'kode_prodi'        => $kode_prodi,
      'nama_fakultas'     => $nama_fakultas,
      'kode_fakultas'     => $kode_fakultas,
      'jenjang'           => $jenjang,
      'angkatan'          => $angkatan,
      'hp'                => $hp,

      'pengajuan_cuti'    => $pengajuan_cuti,
      'cuti'              => $cuti,
      // 'pengajuan'         => $pengajuan,
    ];

    // dd($arrData);

    $view->with('pengajuan', $arrData);
  }
}
