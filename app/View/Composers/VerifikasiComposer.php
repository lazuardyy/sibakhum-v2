<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;

class VerifikasiComposer
{
  public function compose(View $view)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    $unit   = session('user_unit');
    // dd($cmode);

    if($cmode == config('constants.users.dosen')) {
      $url = env('APP_ENDPOINT_DSN') . session('user_username') . '/' . session('user_token');
      $response = Http::get($url);
      $data = json_decode($response);

      if ($data->status == true) {
        foreach ($data->isi as $dsn)
        {
          $kode_prodi = $dsn->prodi;
        }
      }

      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', $kode_prodi)
      // ->where('status_pengajuan','0')
      ->where('status_pengajuan', '>=','0')
      ->get();

      // dd($pengajuan_cuti);
      $pengunduran_diri = PengunduranDiri::where('kode_prodi', $kode_prodi)
      // ->where('status_pengajuan', '0')
      ->where('status_pengajuan', '>=', '0')
      ->get();
      // dd($pengunduran_diri);

      $prodi = env('APP_ENDPOINT_PRODI') . $kode_prodi;
      $responsePr = Http::get($prodi);
      $dataProdi = json_decode($responsePr);
      // dd($dataProdi);

      if ($dataProdi->status == true) {
        foreach ($dataProdi->isi as $prodi)
        {
          $nama_prodi = $prodi->namaProdi;
        }
      }

      $all_pengajuan = '';
    }
    elseif($cmode == config('constants.users.prodi')) {
      $url = env('APP_ENDPOINT_PRODI') . session('user_unit');
      $response = Http::get($url);
      $data = json_decode($response);

      if ($data->status == true) {
        foreach ($data->isi as $prodi)
        {
          $nama_prodi = $prodi->namaProdi;
          $kode_prodi = $prodi->kodeProdi;
        }
      }

      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', 'like', $kode_prodi)
      ->where('status_pengajuan', '>=', '1')
      ->where('status_pengajuan', '!=', '21')
      ->get();
      // dd($pengajuan_cuti);

      $pengunduran_diri = PengunduranDiri::where('kode_prodi', $kode_prodi)
      ->where('status_pengajuan', '>=', '1')
      ->where('status_pengajuan', '!=', '21')
      ->get();

      $all_pengajuan = '';
    }
    elseif($cmode == config('constants.users.dekanat')) {
      // dd($cmode);
      $pengajuan_cuti   = PengajuanCuti::where('kode_fakultas', 'like', trim($unit))
      ->where('status_pengajuan', '>=', '2')
      ->where('status_pengajuan', '!=', '22')
      ->get();
      // dd($pengajuan_cuti);

      $pengunduran_diri = PengunduranDiri::where('kode_fakultas', 'like', trim($unit))
      ->where('status_pengajuan', '>=', '2')
      ->where('status_pengajuan', '!=', '22')
      ->get();

      // dd($pengunduran_diri);

      $kode_prodi = '';
      $nama_prodi = '';
    }
    else {
      $pengajuan_cuti   = PengajuanCuti::where('kode_fakultas', 'like', trim($unit))
      ->where('status_pengajuan', '>=', '3')
      ->where('status_pengajuan', '!=', '23')
      ->get();
      // dd($pengajuan_cuti);

      $pengunduran_diri = PengunduranDiri::where('kode_fakultas', 'like', trim($unit))
      ->where('status_pengajuan', '>=', '3')
      ->where('status_pengajuan', '!=', '23')
      ->get();

      $kode_prodi = '';
      $nama_prodi = '';
    }

    $all_pengajuan = $pengajuan_cuti->merge($pengunduran_diri);
    // dd($all_pengajuan);

    $kodeFakultas = substr($kode_prodi, 0, 2);
    $url = env('APP_ENDPOINT_FK') . (($kodeFakultas === '') ? trim($unit) : $kodeFakultas );
    $responseFk = Http::get($url);
    $results = json_decode($responseFk);

    if ($results->status == true) {
      foreach ($results->isi as $fk)
      {
        $nama_fakultas = $fk->namaFakultas;
      }
    }
    else {
      $nama_fakultas = '';
    }

    $arrData = [
      'pengajuan_cuti'    => $pengajuan_cuti,
      'pengunduran_diri'  => $pengunduran_diri,
      'nama_fakultas'     => $nama_fakultas,
      'nama_prodi'        => $nama_prodi,
      'all_pengajuan'     => $all_pengajuan,
    ];

    $view->with('verifikasi', $arrData);
  }
}
