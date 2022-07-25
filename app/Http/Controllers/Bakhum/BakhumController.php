<?php

namespace App\Http\Controllers\Bakhum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanMhs;
use App\Models\HistoryPengajuan;
use App\Models\BukaPeriode;
use PDF;

class BakhumController extends Controller
{
  public function index (Request $request)
  {
    $status_pembayaran = PengajuanMhs::where('status_pembayaran', '0')->get();

    foreach($status_pembayaran as $pembayaran) {
      $status_pembayaran = $pembayaran->status_pembayaran;
    }

    // if(isset($request->jenis_pengajuan)) {
    //   $request->jenis_pengajuan == 'cuti' ? $jenis_pengajuan = 1 : $jenis_pengajuan = 2;

    //   $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', [5, 6, 7])
    //   ->where('jenis_pengajuan', $jenis_pengajuan)
    //   ->get();
    // }
    // else {
    //   $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', [5, 6, 7])
    //   ->get();
    // }

    $arrData = [
      'title'               => 'Semua Data Pengajuan',
      'subtitle'            => 'Semua Data Pengajuan',
      'modal_title'         => 'Detail Pengajuan',
      'active'              => 'Home',
      'semua_data_active'   => 'active',

      // 'pengajuan_mhs'       => $pengajuan_mhs,
      'status_pembayaran'   => $status_pembayaran
    ];

    return view('bakhum.cetak_surat', $arrData);
  }

  // public function filter ($filter)
  // {
  //   $status_pembayaran = PengajuanMhs::where('status_pembayaran', '0')->get();

  //   foreach($status_pembayaran as $pembayaran) {
  //     $status_pembayaran = $pembayaran->status_pembayaran;
  //   }

  //   $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', [5, 6, 7])
  //   ->where('jenis_pengajuan', (isset($filter) ? $filter : '2'))
  //   ->get();

  //   $arrData = [
  //     'title'               => 'Semua Data Pengajuan',
  //     'subtitle'            => 'Semua Data Pengajuan',
  //     'modal_title'         => 'Detail Pengajuan',
  //     'active'              => 'Home',
  //     'semua_data_active'   => 'active',

  //     'pengajuan_mhs'       => $pengajuan_mhs,
  //     'status_pembayaran'   => $status_pembayaran
  //   ];

  //   return view('bakhum.cetak_surat', $arrData);
  // }

  public function verifikasiBakhum (Request $request)
  {
    // $id_pengajuan = $request->id;
    $id_pengajuan       = $request->id_pengajuan;
    $persetujuan        = $request->persetujuan;
    $jenis_pengajuan    = $request->jenis_pengajuan;
    $no_surat_fakultas  = $request->no_surat_fakultas;
    $no_surat_bakhum    = $request->no_surat_bakhum;
    $alasan             = $request->alasan;
    // dd($no_surat);
    // dd($id_pengajuan, $persetujuan);
    // dd(count($id_pengajuan));
    // dd(session('user_cmode'));

    if($id_pengajuan === null) {
      return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
    }

    for($i = 0; $i < count($id_pengajuan); $i++) {

      if($no_surat_bakhum[$i] === null) {
        return redirect()->back()->with('toast_error', 'Ups! Nomor surat masih kosong!');
      }
      else {
        $persetujuan[$i] = config('constants.status.bk_selesai');
      }

      $store = PengajuanMhs::where([
        'id' => $id_pengajuan[$i]
      ])->update([
        'status_pengajuan' => $persetujuan[$i],
        'no_surat_fakultas' => $no_surat_fakultas[$i],
        'no_surat_bakhum'   => $no_surat_bakhum[$i] ?? '',
      ]);

      // dd($store);

      $pengajuan_jenis = PengajuanMhs::where('id', $id_pengajuan[$i])->value('jenis_pengajuan');

      $histories = HistoryPengajuan::updateOrCreate(
        [
          'id_pengajuan' => $id_pengajuan[$i],
          'v_mode' => trim(session('user_cmode'))
        ],
        [
          'jenis_pengajuan' => $pengajuan_jenis,
          'status_pengajuan' => $persetujuan[$i],
          'alasan' => $alasan
        ]
      );
    }

    try {
      if($store == '1') {
        DB::commit();
        return redirect()->back()->with('toast_success', (session('user_cmode') != config('constants.users.fakultas') ? 'Data Persetujuan Berhasil Diupload' : 'Data Pengajuan Berhasil Diproses'));
      }
    }
    catch(Exeception $e) {
      DB::rollBack();
      return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data' . $e);
    }
  }

  public function download ($id)
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
    // return $pdf->download('surat.pdf');
    return $pdf->stream();
  }
}
