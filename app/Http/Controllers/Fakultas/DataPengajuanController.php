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
use App\Models\PengunduranDiri;
use App\Models\HistoryPengajuan;

class DataPengajuanController extends Controller
{

  public function store (Request $request)
  {
    // $id_pengajuan = $request->id;
    $id_pengajuan = $request->id_pengajuan;
    $persetujuan = $request->persetujuan;
    $jenis_pengajuan = $request->jenis_pengajuan;
    $no_surat = $request->no_surat;
    $alasan = $request->alasan;
    // dd($id_pengajuan, $persetujuan);
    // dd(count($id_pengajuan));

    // if($id_pengajuan === null) {
    //   return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
    // }

    for($i = 0; $i < count($id_pengajuan); $i++) {
      if(session('user_cmode') == config('constants.users.dekanat')){
        if($persetujuan[$i] == '1') {
          $persetujuan[$i] = config('constants.status.wd_setuju');
        }
        else {
          $persetujuan[$i] = config('constants.status.wd_tidak_setuju');
        }
      }
      elseif(session('user_cmode') == config('constants.users.fakultas')){
          // dd($surat);
        if($no_surat[$i] !== null) {
          $status_pengajuan = config('constants.status.fk_selesai');
        }
        else {
          return redirect()->back()->with('toast_error', 'Ups! Nomor surat masih kosong!');
        }
      };

      $store = PengajuanMhs::where([
        'id' => $id_pengajuan[$i]
      ])->update([
        'status_pengajuan' => $persetujuan[$i]
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
        return redirect()->back()->with('toast_success', 'Data Persetujuan Berhasil Diupload');
      }
    }
    catch(Exeception $e) {
      DB::rollBack();
      return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data' . $e);
    }
  }
}
