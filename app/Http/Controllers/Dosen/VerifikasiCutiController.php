<?php

namespace App\Http\Controllers\Dosen;

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

class VerifikasiCutiController extends Controller
{
  public function index ()
  {
    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode !== '8' && $cmode !== '2') {
      return redirect()->to('/home');
    }

    $arrData = [
      'title'               => 'Data Pengajuan Cuti',
      'subtitle'            => 'Data Pengajuan Cuti',
      'modal_title'         => 'Detail Pengajuan Cuti',
      'active'              => 'Home',
      'data_cuti_active'    => 'active',
    ];

    return view('verifikasi.verifikasi_dsn.verifikasi_cuti', $arrData);
  }

    public function store(Request $request)
    {
      $nim                  = $request->nim;
      $status_persetujuan   = $request->status_persetujuan;
      $jenis_pengajuan      = $request->jenis_pengajuan;
      $alasan               = $request->alasan;

      // dd(!$alasan);

      try {
        DB::beginTransaction();

        if(session('user_cmode') == '8') {
          if ($status_persetujuan == '1'){
            $status_pengajuan = '1';
          }
          elseif ($status_persetujuan == '2'){
            $status_pengajuan = '21';
          }
          else{
            return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
          }
        } else {
          if ($status_persetujuan == '1'){
            $status_pengajuan = '2';
          }
          elseif ($status_persetujuan == '2'){
            $status_pengajuan = '22';
          }
          else{
            return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
          }
        }

        $store = PengajuanCuti::where([
          'nim'               => $nim,
        ])->update([
          'status_pengajuan'  => $status_pengajuan
        ]);

        // dd($store);
        $pengajuan_cuti = PengajuanCuti::where('nim', $nim)->get();

        foreach($pengajuan_cuti as $pengajuan){
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

        return redirect()->back()->with('success', 'Data Persetujuan Berhasil Diupload');
      }
      catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data');
      }
    }

    public function show($kodeFakultas)
    {
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
