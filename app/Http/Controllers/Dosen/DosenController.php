<?php

namespace App\Http\Controllers\Dosen;

use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanMhs;
use App\Models\HistoryPengajuan;

class DosenController extends Controller
{
  // function untuk menunjukkan data pengajuan mahasiswa dengan jenis pengajuannya
  public function show ($jenis_pengajuan)
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

    // dosen url to jenis pengajuan
    // if($cmode == config('constants.users.dosen')) {
    //   $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
    //   ->where('pa', session('user_username'))
    //   ->whereIn('status_pengajuan', [0, 1, 21])
    //   ->get();

    // }
    // if($cmode == config('constants.users.prodi')) {
    //   $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
    //   ->where('kode_prodi', trim($unit))
    //   ->whereIn('status_pengajuan', [1, 2, 22])
    //   ->get();
    // }
    if($cmode == config('constants.users.fakultas')) {
      $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
      ->where('kode_fakultas', trim($unit))
      ->whereIn('status_pengajuan', [2])
      ->get();
    }
    elseif($cmode == config('constants.users.dekanat')) {
      $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
      ->where('kode_fakultas', trim($unit))
      ->whereIn('status_pengajuan', [3, 4, 23])
      ->get();
    }
    else {
      // $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
      // ->whereIn('status_pengajuan', (($cmode == config('constants.users.wakil_rektor')) ? [4, 5, 24] : [5]))
      // ->get();
      $pengajuan_mhs = null;
    }

    $arrData = [
      'title'               => ($jenis_pengajuan == 'cuti') ? 'Data Pengajuan Cuti' : 'Data Pengunduran Diri',
      'subtitle'            => ($jenis_pengajuan == 'cuti') ? 'Data Pengajuan Cuti' : 'Data Pengunduran Diri',
      'modal_title'         => ($jenis_pengajuan == 'cuti') ? 'Detail Pengajuan Cuti' : 'Detail Pengunduran Diri',
      'active'              => 'Home',
      ($jenis_pengajuan == 'cuti') ? 'data_cuti_active' : 'data_md_active'    => 'active',

      'pengajuan_mhs'       => $pengajuan_mhs
    ];

    return view('verifikasi.verifikasi_dsn.verifikasi_cuti', $arrData);
  }

  // function untuk menunjukkan detail mahasiswa dengan membuat halaman view baru
  public function detailMhs ($id)
  {
    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    // dd($cmode);
    $unit   = session('user_unit');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $pengajuan   = PengajuanMhs::where('id', base64_decode(base64_decode($id)))->get();
    $pengajuan   = $pengajuan[0];

    $url            = env('APP_ENDPOINT_MHS') . $pengajuan->nim . '/' . session('user_token');
    $response       = Http::get($url);
    $dataMhs        = json_decode($response);
    $dataMhsSiakad  = $dataMhs->isi;
    // dd($dataMhsSiakad);

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

  // function untuk memverifikasi persetujuan dosen pa dan koorprodi
  public function verifikasiDosen (Request $request)
  {
    $nim                  = $request->nim;
    $status_persetujuan   = $request->status_persetujuan;
    $jenis_pengajuan      = $request->jenis_pengajuan;
    $alasan               = $request->alasan;

    // dd(!$alasan);
    // dd(config('constants.status.pa_tidak_setuju'));

    try {
      DB::beginTransaction();

      if(session('user_cmode') == config('constants.users.dosen')) {
        if ($status_persetujuan == '1'){
          $status_pengajuan = config('constants.status.pa_setuju');
        }
        elseif ($status_persetujuan == '2'){
          $status_pengajuan = config('constants.status.pa_tidak_setuju');
        }
        else{
          return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
        }
      }
      elseif(session('user_cmode') == config('constants.users.prodi')) {
        if ($status_persetujuan == '1'){
          $status_pengajuan = config('constants.status.koor_setuju');
        }
        elseif ($status_persetujuan == '2'){
          $status_pengajuan = config('constants.status.koor_tidak_setuju');
        }
        else{
          return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
        }
      }
      elseif(session('user_cmode') == config('constants.users.dekanat')) {
        if ($status_persetujuan == '1'){
          $status_pengajuan = config('constants.status.wd_setuju');
        }
        elseif ($status_persetujuan == '2'){
          $status_pengajuan = config('constants.status.wd_tidak_setuju');
        }
        else{
          return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
        }
      }
      else {
        if ($status_persetujuan == '1'){
          $status_pengajuan = config('constants.status.wr_setuju');
        }
        elseif ($status_persetujuan == '2'){
          $status_pengajuan = config('constants.status.wr_tidak_setuju');
        }
        else{
          return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
        }
      }

      $store = PengajuanMhs::where([
        'nim'               => $nim,
      ])->update([
        'status_pengajuan'  => $status_pengajuan
      ]);

      // dd($store);
      $pengajuan_mhs = DB::table('pengajuan_mhs')->where('nim', $nim)->get('id');

      foreach($pengajuan_mhs as $pengajuan){
        $id = $pengajuan->id;
      }

      // if(isset($request->alasan) === null)

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

      DB::commit();

      return redirect()->back()->with('toast_success', 'Data Persetujuan Berhasil Diupload');
    }
    catch (Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data');
    }
  }
}
