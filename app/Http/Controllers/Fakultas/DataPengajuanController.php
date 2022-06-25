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
    $id_pengajuan = $request->id_pengajuan;
    $persetujuan = $request->persetujuan;
    $jenis_pengajuan = $request->jenis_pengajuan;
    dd($jenis_pengajuan);
    // dd($id_pengajuan);

    if(session('user_cmode') == config('constants.users.dekanat')){
      if($id_pengajuan === null) {
        return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
      }
      elseif($persetujuan == '1') {
        $status_pengajuan = config('constants.status.wd_setuju');
      }
      else {
        $status_pengajuan = config('constants.status.wd_tidak_setuju');
      }
    }
    elseif(session('user_cmode') == config('constants.users.fakultas')){
      if($id_pengajuan === null) {
        return redirect()->back()->with('toast_error', 'Ups! Belum Ada Pilihan Status Persetujuan');
      }
      elseif($no_surat === null) {
        return redirect()->back()->with('toast_error', 'Ups! Nomor surat masih kosong!');
      }
      else {
        $status_pengajuan = config('constants.status.fk_selesai');
        $no_surat;
      }
    }

    try {
      foreach($id_pengajuan as $key => $id) {
        $store = PengajuanMhs::where([
          'id' => $id,
        ])->update([
          'status_pengajuan' => $status_pengajuan,
        ]);

        // $jenis_pengajuan = PengajuanMhs::where('id', $id)->get('jenis_pengajuan');
        // dd($jenis_pengajuan);

        $history = HistoryPengajuan::updateOrCreate (
          [
            'id_pengajuan'      => $id,
            'v_mode'            => trim(session('user_cmode'))
          ],
          [
            'jenis_pengajuan'   => $jenis_pengajuan,
            'status_pengajuan'  => $status_pengajuan,
            'alasan'            => $alasan,
          ]
        );
      }


      return redirect()->back()->with('toast_success', 'Data Persetujuan Berhasil Diupload');
    }
    catch (Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data');
    }
  }
}
