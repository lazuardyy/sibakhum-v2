<?php

namespace App\Http\Controllers\Fakultas;

use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanMhs;
use App\Models\HistoryPengajuan;

class VerifikasiController extends Controller
{
  public function index ()
  {

    $arrData = [
      'title'               => 'Semua Data Pengajuan',
      'subtitle'            => 'Semua Data Pengajuan',
      'modal_title'         => 'Detail Pengajuan',
      'active'              => 'Home',
      'all_data_active'     => 'active',
    ];


    return view('verifikasi.all', $arrData);
  }

  public function verifikasi (Request $request)
  {
    $id_pengajuan       = $request->id_pengajuan;
    $persetujuan        = $request->persetujuan;
    $jenis_pengajuan    = $request->jenis_pengajuan;
    $alasan             = $request->alasan;

    if(session('user_cmode') == config('constants.users.fakultas'))
    {
      $no_surat_fakultas  = $request->no_surat_fakultas;
    }
    else
    {
      $no_surat_fakultas = null;
    }

    if($id_pengajuan === null) {
      return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
    }

    for($i = 0; $i < count($id_pengajuan); $i++) {
      $users = ((session('user_cmode') == config('constants.users.dekanat')));

      if(session('user_cmode') == config('constants.users.dekanat') || session('user_cmode') == config('constants.users.wakil_rektor')){
        if($persetujuan[$i] == '1') {
          $persetujuan[$i] = ($users ? config('constants.status.wd_setuju') : config('constants.status.wr_setuju'));
          // dd($persetujuan[$i]);
        }
        else {
          $persetujuan[$i] = ($users ? config('constants.status.wd_tidak_setuju') : config('constants.status.wr_tidak_setuju'));
          // config('constants.status.wd_tidak_setuju');
        }
      }
      elseif(session('user_cmode') == config('constants.users.fakultas')) {
          // dd($surat);
        if($no_surat_fakultas[$i] === null) {
          return redirect()->back()->with('toast_error', 'Ups! Nomor surat masih kosong!');
        }
        else {
          $persetujuan[$i] = config('constants.status.fk_selesai');
        }
      }

      if($no_surat_fakultas !== null)
      {
        $update = [
          'status_pengajuan'  => $persetujuan[$i],
          'no_surat_fakultas' => $no_surat_fakultas[$i],
        ];

        $add_no_surat = DB::table('ref_surat')->where('pengajuan_mhs_id', $id_pengajuan[$i])->update([
          'no_surat_fakultas' => $no_surat_fakultas[$i],
        ]);
      }
      else
      {
        $update = [
          'status_pengajuan'  => $persetujuan[$i],
        ];
      }

      $store = DB::table('pengajuan_mhs')->where('id', $id_pengajuan[$i])
              ->update($update);

      // $store = PengajuanMhs::where([
      //   'id'                => $id_pengajuan[$i]
      // ])->update([
      //   'status_pengajuan'  => $persetujuan[$i],
      //   'no_surat_fakultas' => $no_surat_fakultas[$i],
      // ]);

      // dd($store);

      $pengajuan_jenis = PengajuanMhs::where('id', $id_pengajuan[$i])->value('jenis_pengajuan');

      $histories = HistoryPengajuan::updateOrCreate(
        [
          'id_pengajuan'     => $id_pengajuan[$i],
          'v_mode'           => trim(session('user_cmode'))
        ],
        [
          'jenis_pengajuan'  => $pengajuan_jenis,
          'status_pengajuan' => $persetujuan[$i],
          'alasan'           => $alasan
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
}
