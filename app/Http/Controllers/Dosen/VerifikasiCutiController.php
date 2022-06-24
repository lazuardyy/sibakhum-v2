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
use App\Models\PengunduranDiri;
use App\Models\HistoryPengajuan;

class VerifikasiCutiController extends Controller
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

    $pengajuan_mhs = PengajuanMhs::where('kode_fakultas', trim($unit))->get();
    // $pengajuan_md   = PengunduranDiri::where('kode_fakultas', trim($unit))->get();
    // dd($pengajuan_md);

    $arrData = [
      'title'               => 'Semua Data Pengajuan',
      'subtitle'            => 'Semua Data Pengajuan',
      'modal_title'         => 'Detail Pengajuan',
      'active'              => 'Home',
      'all_data_active'     => 'active',

      'pengajuan_mhs'       => $pengajuan_mhs,
      // 'pengajuan_md'        => $pengajuan_md,
    ];

    // dd($arrData);

    return view('verifikasi.all', $arrData);
  }

  public function show ($jenis_pengajuan)
  {
    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');
    $unit   = session('user_unit');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode === config('constants.users.mahasiswa')) {
      return redirect()->to('/home');
    }

    // dosen url to jenis pengajuan
    if($cmode == config('constants.users.dosen')) {
      $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
      ->where('pa', session('user_username'))
      ->where('status_pengajuan', '>=','0')
      ->get();
    }
    elseif($cmode == config('constants.users.prodi')) {
      $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
      ->where('kode_prodi', trim($unit))
      ->where('status_pengajuan', '>=', '1')
      ->where('status_pengajuan', '!=', '21')
      ->get();
    }
    elseif($cmode == config('constants.users.dekanat')) {
      $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
      ->where('kode_fakultas', trim($unit))
      ->where('status_pengajuan', '>=', '2')
      ->where('status_pengajuan', '!=', '22')
      ->get();
    }
    else {
      $pengajuan_mhs = PengajuanMhs::where('jenis_pengajuan', ($jenis_pengajuan == 'cuti') ? 1 : 2)
      ->where('kode_fakultas', trim($unit))
      ->where('status_pengajuan', '>=', '4')
      ->where('status_pengajuan', '!=', '21')
      ->where('status_pengajuan', '!=', '22')
      ->where('status_pengajuan', '!=', '23')
      ->where('status_pengajuan', '!=', '24')
      ->get();
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

  public function detailMhs ($nim)
  {
    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');
    // dd($cmode);
    $unit   = session('user_unit');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $pengajuan   = PengajuanMhs::where('nim', base64_decode(base64_decode($nim)))->first();

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

    public function store(Request $request)
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

        $store = PengajuanMhs::where([
          'nim'               => $nim,
        ])->update([
          'status_pengajuan'  => $status_pengajuan
        ]);

        // dd($store);
        $pengajuan_mhs = PengajuanMhs::where('nim', $nim)->get();

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

    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
