<?php

namespace App\Http\Controllers\Fakultas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanMhs;
use App\Models\HistoryPengajuan;
use App\Models\BukaPeriode;
use PDF;

class PersuratanFakultasController extends Controller
{
  public function surat_masuk_bakhum ()
  {

    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    $unit   = session('user_unit');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode === config('constants.users.mahasiswa')) {
      return redirect()->to('/home');
    }

    $pengajuan_mhs = PengajuanMhs::where('kode_fakultas', trim($unit))
    ->whereIn('status_pengajuan', [7])
    ->get();

    $arrData = [
      'title'               => 'Surat Masuk',
      'subtitle'            => route('surat.bakhum'),
      'active'              => 'Home',
      'surat_active'        => 'active',

      'pengajuan_mhs'       => $pengajuan_mhs
    ];


    return view('fakultas.surat', $arrData);
  }

  public function surat_masuk_prodi (PengajuanMhs $pengajuan)
  {
    // dd($pengajuan);
    $pengajuan_mhs = PengajuanMhs::with('refSurat')->findOrFail($pengajuan->id);
    $pengajuan_mhs = json_decode($pengajuan_mhs);
    // dd($pengajuan_mhs);

    // get data mhs from siakad
    $get_data_fakultas = Http::get(env('APP_ENDPOINT_FK') . $pengajuan->kode_fakultas);
    $get_data_fakultas = json_decode($get_data_fakultas);
    // dd($get_data_fakultas->isi[0]->wd1Fakultas);

    $url_dosen = env('APP_ENDPOINT_DSN') . $get_data_fakultas->isi[0]->wd1Fakultas . '/' . env('APP_AUTH');

    $get_data_dosen = Http::get($url_dosen);
    $get_data_dosen = json_decode($get_data_dosen);
    $get_data_dosen = $get_data_dosen->isi[0];

    if($get_data_fakultas->status === true)
    {
      $get_data_fakultas = $get_data_fakultas->isi[0];
    }
    else
    {
      $get_data_fakultas = null;
    }

    $history = HistoryPengajuan::where('id_pengajuan', $pengajuan_mhs->id)
    ->where('status_pengajuan', 4)
    ->get();
    $history = json_decode($history);

    $periode = BukaPeriode::where('aktif', '1')->first();
    $periode = json_decode($periode);
    // dd($periode);


    $pdf = PDF::loadView('fakultas.pdf_pengajuan_md', [
      'pengajuan' => $pengajuan_mhs,
      'dosen'     => $get_data_dosen,
      'history'   => $history,
      'periode'   => $periode,
      'fakultas'  => $get_data_fakultas,
    ]);

    $jenis_pengajuan = $pengajuan_mhs->jenis_pengajuan == 1 ? 'Cuti' : 'Keterangan';
    $file_name ='Surat ' .$jenis_pengajuan. '_' .$pengajuan_mhs->nama. '_'. $pengajuan_mhs->nim . '.pdf';

    // return $pdf->download($file_name);
    return $pdf->stream();
  }

  public function kirim_permohonan (Request $request)
  {
    $id_pengajuan         = $request->id_pengajuan;
    $persetujuan          = $request->persetujuan;

    if($id_pengajuan === null) {
      return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
    }

    try {
      if($request->hasFile('file_permohonan_md'))
      {
        $file_permohonan_md = $request->file('file_permohonan_md');

        foreach($file_permohonan_md as $key => $file)
        {
          $original_name  = trim($file->getClientOriginalName(), '.pdf');
          $original_ext   = $file->getClientOriginalExtension();
          $file_name      = $original_name. '_'. date('dmY') . '.' . $original_ext;
          $new_file_name  = 'file_permohonan_md/'.$original_name. '_'. date('dmY') . '.' . $original_ext;
          $store          = $file->storeAs('file_permohonan_md', $file_name);

          // store to database
          $upload_file_permohonan = DB::table('ref_file_pengajuan')->where('pengajuan_mhs_id', $id_pengajuan[$key])->update([
            'file_permohonan_md' => $new_file_name
          ]);

          dump('surat ', $upload_file_permohonan);
        }
      }

      for($i = 0; $i < count($id_pengajuan); $i++) {
        $persetujuan[$i] = config('constants.status.fk_selesai');

        $store = PengajuanMhs::where([
          'id' => $id_pengajuan[$i]
        ])->update([
          'status_pengajuan' => $persetujuan[$i],
        ]);

        dump($store);


        $pengajuan_jenis = PengajuanMhs::where('id', $id_pengajuan[$i])->value('jenis_pengajuan');

        $histories = HistoryPengajuan::updateOrCreate(
          [
            'id_pengajuan'      => $id_pengajuan[$i],
            'v_mode'            => trim(session('user_cmode'))
          ],
          [
            'jenis_pengajuan'   => $pengajuan_jenis,
            'status_pengajuan'  => $persetujuan[$i],
          ]
        );
      }

      DB::commit();
      return redirect()->back()->with('toast_success', 'berhasil');

    }
    catch(err)
    {
      DB::rollback();
      return redirect()->back()->with('toast_success', 'gagal');
    }
  }

  public function download_sk ($id)
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

    $file_name = $pengajuan_mhs->nama . '_' . $pengajuan_mhs->nim . '_' . (($pengajuan_mhs->jenis_pengajuan == 1) ? 'Surat Keterangan Cuti' : 'Surat Keterangan Pengunduran Diri');
    // dd($file_name);
    // return $pdf->download('surat.pdf');
    return $pdf->download($file_name);
  }
}
