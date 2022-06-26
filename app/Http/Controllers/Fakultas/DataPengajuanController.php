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
    $no_surat = $request->no_surat;
    $alasan = $request->alasan;

    // $all_data = $request->all();
    // dd($all_data);

    // dd($no_surat, $id_pengajuan);
    // dd($jenis_pengajuan, $id_pengajuan);
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
      foreach($no_surat as $surat){
        // dd($surat);
        if($surat !== null) {
          $status_pengajuan = config('constants.status.fk_selesai');
          $surat;
        }
        else {
          return redirect()->back()->with('toast_error', 'Ups! Nomor surat masih kosong!');
        }
      }
    };



    try {
      foreach($id_pengajuan as $key => $id) {
        // dd($id);
        // $jenis_pengajuan = PengajuanMhs::where('id', $id)->get('jenis_pengajuan');
        // dd($jenis_pengajuan);
        // foreach($jenis_pengajuan as $key => $pengajuan) {
          $store = PengajuanMhs::where([
            'id' => $id,
          ])->update([
            'status_pengajuan' => $status_pengajuan,
            (session('user_cmode') == config('constants.users.fakultas') ? 'no_surat' : '') => (session('user_cmode') == config('constants.users.fakultas') ? $surat : '')
          ]);

          // dd($key);

          // foreach($jenis_pengajuan as $pengajuan){
            // if($pengajuan !== null) {

            // }
          // }



          // dd($history);
        // }

      }

      for($i = 0; $i < count($jenis_pengajuan); $i++) {
        $history = HistoryPengajuan::updateOrCreate (
          [
            'id_pengajuan'      => $id,
            'v_mode'            => trim(session('user_cmode'))
          ],
          [
            'jenis_pengajuan'   => $jenis_pengajuan[$i],
            'status_pengajuan'  => $status_pengajuan,
            'alasan'            => $alasan,
          ]
        );
      }
      // dd($data);
      // dd($data);

      DB::commit();

      return redirect()->back()->with('toast_success', 'Data Persetujuan Berhasil Diupload');
    }
    catch (Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data');
    }
  }
}
