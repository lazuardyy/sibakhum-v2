<?php

namespace App\Http\Controllers\Bakhum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanMhs;
use App\Models\HistoryPengajuan;
use Exception;

class PersuratanBakhumController extends Controller
{
  public function index_surat ()
  {
    // dd($slug);
    $user = session('user_cmode');

    $user == config('constants.users.bakhum') ? $route = route('surat.upload_sk') : $route = route('surat.kirim_permohonan');

    $arrData = [
      'title'               => 'Kirim Surat Keterangan',
      'subtitle'            => route('surat.index_surat'),
      'active'              => 'Home',
      'route'               => $route,
      'kirim_data_active'   => 'active',
    ];

    return view('persuratan.index', $arrData);
  }

  public function upload_sk (Request $request)
  {
    // $validate = $request->validate([
    //   'file_sk' => 'file|mimes:pdf, doc, docx|max:2048'
    // ]);

    $id_pengajuan       = $request->id_pengajuan;
    $persetujuan        = $request->persetujuan;
    $jenis_pengajuan    = $request->jenis_pengajuan;
    $alasan             = $request->alasan;
    $file_sk            = $request->file('file_sk');

    // $file_sk = array();
    if(isset($file_sk))
    {
      foreach($file_sk as $file) {
        $new_sk[] = $file->store('file_sk');
      }
    }


    if($id_pengajuan === null) {
      return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
    }

    for($i = 0; $i < count($id_pengajuan); $i++) {
      $persetujuan[$i] = config('constants.status.pengajuan_selesai');

      $store = PengajuanMhs::where([
        'id' => $id_pengajuan[$i]
      ])->update([
        'status_pengajuan' => $persetujuan[$i],
        'file_sk'          => $new_sk[$i]
      ]);

      $upload_sk = DB::table('ref_file_pengajuan')->where('pengajuan_mhs_id', $id_pengajuan[$i])->update([
        'file_sk'          => $new_sk[$i]
      ]);

      $pengajuan_jenis = PengajuanMhs::where('id', $id_pengajuan[$i])->value('jenis_pengajuan');

      $histories = HistoryPengajuan::updateOrCreate(
        [
          'id_pengajuan'      => $id_pengajuan[$i],
          'v_mode'            => trim(session('user_cmode'))
        ],
        [
          'jenis_pengajuan'   => $pengajuan_jenis,
          'status_pengajuan'  => $persetujuan[$i],
          'alasan'            => $alasan
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
