<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\PengajuanMhs;

class Pengajuan {
  public $date;
  public $jumlah;

  public function __construct($date, $jumlah) {
    $this->date  = $date;
    $this->jumlah = $jumlah;
  }

  public function getBulan () {
    return $this->date;
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
    $disetujui = array();
    $diproses  = array();
    $ditolak   = array();

    $pa = array();
    $koor = array();
    $wd = array();
    $wr = array();

    $jan = array();
    $feb = array();
    $mar = array();
    $apr = array();
    $mei = array();
    $jun = array();
    $jul = array();
    $aug = array();
    $sep = array();
    $oct = array();
    $nov = array();
    $des = array();

    if(($kodeFakultas === 'All' && DB::table('pengajuan_mhs')->exists()) || DB::table('pengajuan_mhs')->where('kode_fakultas', $kodeFakultas)->exists()) {
      $url = 'http://103.8.12.212:36880/siakad_api/api/as400/fakultas/';

      $getFakultas = Http::get($url . $kodeFakultas);
      $getFakultas = $getFakultas['isi'];

      foreach($getFakultas as $key => $fakultas)
      {
        $pengajuan_mhs = DB::table('pengajuan_mhs')->where('kode_fakultas', $fakultas['kodeFakultas']);

        if($pengajuan_mhs->exists())
        {
          $datas = $pengajuan_mhs->get();

          foreach($datas as $key => $pengajuan)
          {
            if($pengajuan->status_pengajuan < 7)
            {
              $diproses[] = $pengajuan->status_pengajuan;

              if($pengajuan->status_pengajuan === 0)
              {
                $pa[] = $pengajuan->status_pengajuan;
              }
              elseif($pengajuan->status_pengajuan === 1)
              {
                $koor[] = $pengajuan->status_pengajuan;
              }
              elseif($pengajuan->status_pengajuan === 3)
              {
                $wd[] = $pengajuan->status_pengajuan;
              }
              elseif($pengajuan->status_pengajuan === 4)
              {
                $wr[] = $pengajuan->status_pengajuan;
              }
              else
              {
                $pa   = array();
                $koor = array();
                $wd   = array();
                $wr   = array();
              }
            }
            elseif($pengajuan->status_pengajuan > 7)
            {
              $ditolak[] = $pengajuan->status_pengajuan;
            }
            elseif($pengajuan->status_pengajuan === 7)
            {
              $disetujui[] = $pengajuan->status_pengajuan;
            }
            else
            {
              $diproses = array();
              $ditolak = array();
              $disetujui = array();
            }
          }
        }
        else
        {
          $diproses  = array();
          $ditolak   = array();
          $disetujui = array();
          $datas     = array();

          $pa = array();
          $koor = array();
          $wd = array();
          $wr = array();
        }


        // $diproses = $pengajuan_mhs->where('status_pengajuan', '<', '7')->pluck('status_pengajuan');
        // $ditolak  = $pengajuan_mhs->where('status_pengajuan', '>', '7')->pluck('status_pengajuan');
        // $disetujui  = $pengajuan_mhs->where('status_pengajuan','=', '7')->pluck('status_pengajuan');

        $dataPengajuan[] = [
          'nama'               => $fakultas['namaFakultas'],
          'kode_fakultas'      => $fakultas['kodeFakultas'],
          'pengajuan_diproses' => count($diproses),
          'pengajuan_ditolak'  => count($ditolak),
          'pengajuan_disetujui'=> count($disetujui),
          'jumlah_pengajuan'   => count($datas)
        ];

        $status_pengajuan[] = [
          'nama'               => $fakultas['namaFakultas'],
          'pa_proses'          => count($pa),
          'prodi_proses'       => count($koor),
          'wd_proses'          => count($wd),
          'wr_proses'          => count($wr)
        ];
      }

      $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'];
      // $pengajuan_created = DB::table('pengajuan_mhs')->select('created_at')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))"),"2022-07")->get();

      if($kodeFakultas == 'All')
      {
        $pengajuan_created = DB::table('pengajuan_mhs')->pluck('created_at');
      }
      else
      {
        $pengajuan_created = DB::table('pengajuan_mhs')->where('kode_fakultas', $kodeFakultas)->pluck('created_at');
      }

      foreach($pengajuan_created as $key => $pengajuan)
      {
        $date = date('M', strtotime($pengajuan));
        $date_check = in_array($date, $months);

        if($date == 'Jan')
        {
          $jan[] = $date;
        }
        elseif($date == 'Feb')
        {
          $feb[] = $date;
        }
        elseif($date == 'Mar')
        {
          $mar[] = $date;
        }
        elseif($date == 'Apr')
        {
          $apr[] = $date;
        }
        elseif($date == 'Mei')
        {
          $mei[] = $date;
        }
        elseif($date == 'Jun')
        {
          $jun[] = $date;
        }
        elseif($date == 'Jul')
        {
          $jul[] = $date;
        }
        elseif($date == 'Aug')
        {
          $aug[] = $date;
        }
        elseif($date == 'Sep')
        {
          $sep[] = $date;
        }
        elseif($date == 'Oct')
        {
          $oct[] = $date;
        }
        elseif($date == 'Nov')
        {
          $nov[] = $date;
        }
        else
        {
          $des[] = $date;
        }
      }

      $pengajuan = [
        [
          'nama'   => 'Jan',
          'jumlah' => count($jan)
        ],
        [
          'nama'   => 'Feb',
          'jumlah' => count($feb)
        ],
        [
          'nama'   => 'Mar',
          'jumlah' => count($mar)
        ],
        [
          'nama'   => 'Apr',
          'jumlah' => count($apr)
        ],
        [
          'nama'   => 'Mei',
          'jumlah' => count($mei)
        ],
        [
          'nama'   => 'Jun',
          'jumlah' => count($jun)
        ],
        [
          'nama'   => 'Jul',
          'jumlah' => count($jul)
        ],
        [
          'nama'   => 'Aug',
          'jumlah' => count($aug)
        ],
        [
          'nama'   => 'Sep',
          'jumlah' => count($sep)
        ],
        [
          'nama'   => 'Oct',
          'jumlah' => count($oct)
        ],
        [
          'nama'   => 'Nov',
          'jumlah' => count($nov)
        ],
        [
          'nama'   => 'Des',
          'jumlah' => count($des)
        ],
      ];

      // $month[] = new Pengajuan($jul[0], count($jul));

      $data = [
        'status'             => 200,
        'data'               => [
          'per_bulan'          => $pengajuan,
          'per_fakultas'       => $dataPengajuan,
          'per_status'         => $status_pengajuan
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

  public function pengajuan_mahasiswa ($nim)
  {
    $pengajuan_mhs = DB::table('pengajuan_mhs')->where('nim', $nim);

    if($pengajuan_mhs->exists())
    {
      $pengajuan_mhs = $pengajuan_mhs->get();

      $data = [
        'status'             => 200,
        'data'               => $pengajuan_mhs,
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
