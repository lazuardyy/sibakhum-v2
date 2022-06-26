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
    // dd($persetujuan);

    if($id_pengajuan === null) {
      return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
    }

    for($i = 0; $i < count($id_pengajuan); $i++) {
      if(session('user_cmode') == config('constants.users.dekanat')){
        if($persetujuan[$i] == '1') {
          $status_pengajuan = config('constants.status.wd_setuju');
        }
        else {
          $status_pengajuan = config('constants.status.wd_tidak_setuju');
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

      try {
        $store = PengajuanMhs::where([
          'id' => $id_pengajuan[$i]
        ])->update([
          'status_pengajuan' => $status_pengajuan
        ]);

        $pengajuan_jenis = PengajuanMhs::where('id', $id_pengajuan[$i])->value('jenis_pengajuan');

        $histories = HistoryPengajuan::updateOrCreate([
          'id_pengajuan' => $id_pengajuan[$i],
          'v_mode' => trim(session('user_cmode'))
        ],
        [
          'jenis_pengajuan' => $pengajuan_jenis,
          'status_pengajuan' => $status_pengajuan,
          'alasan' => $alasan
        ]);

        DB::commit();

        return redirect()->back()->with('toast_success', 'Data Persetujuan Berhasil Diupload');
      }
      catch(Exeception $e) {
        DB::rollBack();
        return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data' . $e);
      }
    }




    // dd($histories);



    // $all_data = $request->all();
    // dd($all_data);

    // dd($no_surat, $id_pengajuan);
    // dd($jenis_pengajuan, $id_pengajuan);
    // dd($id_pengajuan);





    // try {
    //   foreach($id_pengajuan as $key => $id) {
    //       $store = PengajuanMhs::where([
    //         'id' => $id,
    //       ])->update([
    //         'status_pengajuan' => $status_pengajuan,
    //         (session('user_cmode') == config('constants.users.fakultas') ? 'no_surat' : '') => (session('user_cmode') == config('constants.users.fakultas') ? $surat : '')
    //       ]);

    //   }

    //   DB::commit();

    //   return redirect()->back()->with('toast_success', 'Data Persetujuan Berhasil Diupload');
    // }
    // catch (Exception $e) {
    //   DB::rollBack();
    //   return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data');
    // }
  }
}
