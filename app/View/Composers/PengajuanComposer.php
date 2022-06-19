<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanCuti;
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
        $nama_lengkap   = $mhs->nama;
        $jenis_kelamin  = $mhs->kelamin;
        $nama_prodi     = $mhs->namaProdi;
        $kode_prodi     = $mhs->kodeProdi;
        $nama_fakultas  = $mhs->namaFakultas;
        $angkatan       = $mhs->angkatan;
        $hp             = $mhs->hpm;
      }
    }
    else
    {
      $nim              = 'kosong';
      $nama_lengkap     = 'kosong';
      $jenis_kelamin    = 'kosong';
      $nama_prodi       = 'kosong';
      $kode_prodi       = 'kosong';
      $nama_fakultas    = 'kosong';
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

    $pengajuan_cuti = PengajuanCuti::where('nim', session('user_username'))->get();
    $pengunduran_diri = PengunduranDiri::where('nim', session('user_username'))->get();

    $arrData = [
      'nim'               => $nim,
      'nama_lengkap'      => $nama_lengkap,
      'jenis_kelamin'     => $jenis_kelamin,
      'nama_prodi'        => $nama_prodi,
      'kode_prodi'        => $kode_prodi,
      'nama_fakultas'     => $nama_fakultas,
      'kode_fakultas'     => $kode_fakultas,
      'angkatan'          => $angkatan,
      'hp'                => $hp,

      'pengajuan_cuti'    => $pengajuan_cuti,
      'pengunduran_diri'  => $pengunduran_diri,
    ];

    // dd($arrData);

    $view->with('pengajuan', $arrData);
  }
}
