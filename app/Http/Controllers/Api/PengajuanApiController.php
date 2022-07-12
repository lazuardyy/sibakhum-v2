<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanMhs;

class Pengajuan {
  public $bulan;
  public $jumlah;

  public function __construct($bulan, $jumlah) {
    $this->bulan = $bulan;
    $this->jumlah = $jumlah;
  }

  public function getBulan () {
    return $this->bulan;
  }

  public function getJumlah () {
    return $this->jumlah;
  }
}

class PengajuanApiController extends Controller
{
  public function dataPengajuanProdi ()
  {

  }

  public function dataPengajuanFakultas ($kodeFakultas)
  {
    if(DB::table('pengajuan_mhs')->where('kode_fakultas', $kodeFakultas)->exists()) {
      $pengajuanFakultas = PengajuanMhs::where('kode_fakultas', $kodeFakultas)->get();
      $jumlahPengajuan = count($pengajuanFakultas);

      $semuaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'];

      foreach($semuaBulan as $key => $bulan) {
        $month[] = new Pengajuan($bulan, $key);
      }

      $disetujui = array();
      $diproses = array();
      $ditolak = array();


      foreach($pengajuanFakultas as $key => $pengajuan) {
        $status_pengajuan = $pengajuan->status_pengajuan;
        $namaBulan[] = date_format($pengajuan->created_at, 'M');

        if($status_pengajuan === 7)
        {
          $disetujui[] = $status_pengajuan;
        }
        elseif($status_pengajuan < 7)
        {
          $diproses[]  = $status_pengajuan;
        }
        else {
          $ditolak[]  = $status_pengajuan;
        }
      }

      $data = [
        'status'             => 200,
        'data'               => [
          'nama_bulan'         => $namaBulan,
          'per_bulan'          => $month,
          'total_pengajuan'    => $jumlahPengajuan,
          'pengajuan_diproses' => count($diproses),
          'pengajuan_disetujui'=> count($disetujui),
          'pengajuan_ditolak'  => count($ditolak),
        ],
        'message'            => 'Data berhasil ditemukan'
      ];
    }
    else {
      $data = [
        'status'  => 404,
        'message' => 'Data tidak ditemukan'
      ];
    }

    return $data;
  }
}
