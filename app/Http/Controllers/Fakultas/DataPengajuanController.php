<?php

namespace App\Http\Controllers\Fakultas;

use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;
use App\Models\HistoryPengajuan;

class DataPengajuanController extends Controller
{
  public function index ()
  {
    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    $unit   = session('user_unit');

    if(!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode !== config('constants.users.fakultas') && $cmode !== config('constants.users.dekanat')) {
      return redirect()->to('/home');
    }

    $pengajuan_cuti = PengajuanCuti::where('kode_fakultas', trim($unit))->get();
    $pengajuan_md   = PengunduranDiri::where('kode_fakultas', trim($unit))->get();
    // dd($pengajuan_md);

    $arrData = [
      'title'               => 'Semua Data Pengajuan',
      'subtitle'            => 'Semua Data Pengajuan',
      'modal_title'         => 'Detail Pengajuan',
      'active'              => 'Home',
      'all_data_active'     => 'active',

      'pengajuan_cuti'      => $pengajuan_cuti,
      'pengajuan_md'        => $pengajuan_md,
    ];

    // dd($arrData);

    return view('verifikasi.all', $arrData);
  }

  public function show($nim)
  {
    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    // dd($cmode);
    $unit   = session('user_unit');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    // dd($nim);

    $pengajuan_cuti   = PengajuanCuti::where('nim', base64_decode(base64_decode($nim)))->first();
    // dd($pengajuan_cuti);
    $pengunduran_diri = PengunduranDiri::where('nim', base64_decode(base64_decode($nim)))->first();

    if(isset($pengajuan_cuti)){
      $pengajuan  = PengajuanCuti::where('nim', base64_decode(base64_decode($nim)))->first();
    }
    elseif(isset($pengunduran_diri)){
      $pengajuan  = PengunduranDiri::where('nim', base64_decode(base64_decode($nim)))->first();
    }

    $url            = env('APP_ENDPOINT_MHS') . base64_decode(base64_decode($nim)) . '/' . session('user_token');
    $response       = Http::get($url);
    $dataMhs        = json_decode($response);
    $dataMhsSiakad  = $dataMhs->isi;

    foreach($dataMhsSiakad as $mhs){
      $nama_prodi     = $mhs->namaProdi;
      $nama_fakultas  = $mhs->namaFakultas;
    }

    $arrData = [
      'title'               => 'Detail Data Pengajuan',
      'subtitle'            => 'Detail Data Pengajuan',
      'active'              => 'Home',
      'all_data_active'     => 'active',

      'pengajuan'           => $pengajuan,
      'data_mhs'            => $dataMhsSiakad,
      'nama_prodi'          => $nama_prodi,
      'nama_fakultas'       => $nama_fakultas,
    ];

    return view('verifikasi.detail', $arrData);
  }

  public function store (Request $request)
  {
    $id                        = $request->id;
    $nim                       = $request->nim;
    $jenis_pengajuan           = $request->jenis_pengajuan;
    $status_persetujuan        = $request->status_persetujuan;
    $alasan                    = $request->alasan;
    $no_surat                  = $request->no_surat;

    // dd(compact('no_surat', 'nim'));

    dd(array_merge($nim, $id));

    try {
      DB::beginTransaction();

      if(session('user_cmode') == config('constants.users.dekanat')){
        if($status_persetujuan == '1') {
          $status_pengajuan = config('constants.status.wd_setuju');
        }
        elseif($status_persetujuan == '2') {
          $status_pengajuan = config('constants.status.wd_tidak_setuju');
        }
        else{
          return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
        }
      }
      elseif(session('user_cmode') == config('constants.users.fakultas')){
        if($status_persetujuan == '1' && $no_surat !== null) {
          $status_pengajuan = config('constants.status.fk_selesai');
          $no_surat;
        }
        elseif($no_surat === null) {
          return redirect()->back()->with('toast_error', 'Ups! nomor surat masih kosong!');
        }
        else{
          return redirect()->back()->with('toast_error', 'Ups! belum ada data terpilih!');
        }
      }

      if($jenis_pengajuan_cuti !== null && $jenis_pengajuan_md !== null){
        $store_cuti = PengajuanCuti::where([
          'id'                => $id_cuti,
          'nim'               => $nim_cuti,
          'jenis_pengajuan'   => $jenis_pengajuan_cuti,
        ])->update([
          'status_pengajuan'  => $status_pengajuan,
          (session('user_cmode') == config('constants.users.fakultas') ? 'no_surat' : '') => (session('user_cmode') == config('constants.users.fakultas') ? $no_surat : '')
        ]);

        $store_md = PengunduranDiri::where([
          'id'                => $id_md,
          'nim'               => $nim_md,
          'jenis_pengajuan'   => $jenis_pengajuan_md,
        ])->update([
          'status_pengajuan'  => $status_pengajuan,
          (session('user_cmode') == config('constants.users.fakultas') ? 'no_surat' : '') => (session('user_cmode') == config('constants.users.fakultas') ? $no_surat : '')
        ]);

        $history_cuti = HistoryPengajuan::updateOrCreate (
          [
            'id_pengajuan'      => $id_cuti,
            'v_mode'            => trim(session('user_cmode'))
          ],
          [
            'jenis_pengajuan'   => $jenis_pengajuan_cuti,
            'status_pengajuan'  => $status_pengajuan,
            'alasan'            => $alasan,
          ]
        );

        $history_md = HistoryPengajuan::updateOrCreate (
          [
            'id_pengajuan'      => $id_md,
            'v_mode'            => trim(session('user_cmode'))
          ],
          [
            'jenis_pengajuan'   => $jenis_pengajuan_md,
            'status_pengajuan'  => $status_pengajuan,
            'alasan'            => $alasan,
          ]
        );
      }
      elseif($jenis_pengajuan_cuti == '1' && $jenis_pengajuan_md === null){
        $store_cuti = PengajuanCuti::where([
          'id'                => $id_cuti,
          'nim'               => $nim_cuti,
          'jenis_pengajuan'   => $jenis_pengajuan_cuti,
        ])->update([
          'status_pengajuan'  => $status_pengajuan,
          (session('user_cmode') == config('constants.users.fakultas') ? 'no_surat' : '') => (session('user_cmode') == config('constants.users.fakultas') ? $no_surat : '')
        ]);

        $history_cuti = HistoryPengajuan::updateOrCreate (
          [
            'id_pengajuan'      => $id_cuti,
            'v_mode'            => trim(session('user_cmode'))
          ],
          [
            'jenis_pengajuan'   => $jenis_pengajuan_cuti,
            'status_pengajuan'  => $status_pengajuan,
            'alasan'            => $alasan,
          ]
        );
      }
      else {
        $store_md = PengunduranDiri::where([
          'id'                => $id_md,
          'nim'               => $nim_md,
          'jenis_pengajuan'   => $jenis_pengajuan_md,
        ])->update([
          'status_pengajuan'  => $status_pengajuan,
          (session('user_cmode') == config('constants.users.fakultas') ? 'no_surat' : '') => (session('user_cmode') == config('constants.users.fakultas') ? $no_surat : '')
        ]);

        $history_md = HistoryPengajuan::updateOrCreate (
          [
            'id_pengajuan'      => $id_md,
            'v_mode'            => trim(session('user_cmode'))
          ],
          [
            'jenis_pengajuan'   => $jenis_pengajuan_md,
            'status_pengajuan'  => $status_pengajuan,
            'alasan'            => $alasan,
          ]
        );
      }


      DB::commit();

      return redirect()->back()->with('toast_success', 'Data Persetujuan Berhasil Diupload');
    }
    catch (Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data');
    }
  }
}
