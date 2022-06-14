<?php

namespace App\Http\Controllers\Dosen;

use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengunduranDiri;
use App\Models\PengajuanCuti;
use App\Models\HistoryPengajuan;

class VerifikasiMdController extends Controller
{
  public function index ()
  {
    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    // dd(session('user_cmode'));

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode !== '8' && $cmode !== '2') {
      return redirect()->to('/home');
    }

    $arrData = [
      'title' => 'Data Pengunduran Diri',
      'subtitle' => 'Data Pengunduran Diri',
      'modal_title' => 'Detail Pengunduran Diri',
      'active' => 'Home',
      'data_md_active' => 'active',
    ];

    return view('verifikasi.verifikasi_dsn.verifikasi_md', $arrData);
  }

  public function store(Request $request)
  {
    $nim                  = $request->nim;
    $status_persetujuan   = $request->status_persetujuan;
    $jenis_pengajuan      = $request->jenis_pengajuan;
    $alasan               = $request->alasan;

    // dd($jenis_pengajuan);

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

      $store = PengunduranDiri::where([
        'nim'               => $nim,
      ])->update([
        'status_pengajuan'  => $status_pengajuan
      ]);

      // dd($store);
      $pengunduran_diri = PengunduranDiri::where('jenis_pengajuan', $jenis_pengajuan)->get();

      foreach($pengunduran_diri as $pengajuan){
        $id = $pengajuan->id;
      }


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

  public function update(Request $request, $id)
  {
      //
  }

  public function destroy($id)
  {
      //
  }
}
