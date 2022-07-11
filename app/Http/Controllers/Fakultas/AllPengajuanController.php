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

class AllPengajuanController extends Controller
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
    elseif($cmode == config('constants.users.dosen') && $cmode == config('constants.users.mahasiswa')) {
      return redirect()->to('/home');
    }

    if($cmode == config('constants.users.dekanat')) {
      $pengajuan_mhs = PengajuanMhs::where('kode_fakultas', trim($unit))
      ->whereIn('status_pengajuan', [3, 4, 23])
      ->get();
    }
    elseif($cmode == config('constants.users.wakil_rektor')) {
      $pengajuan_mhs = PengajuanMhs::whereIn('status_pengajuan', [4, 24])
      ->get();

      // dump($pengajuan_mhs);
    }
    elseif($cmode == config('constants.users.fakultas')) {
      $pengajuan_mhs = PengajuanMhs::where('kode_fakultas', trim($unit))
      ->whereIn('status_pengajuan', [2])
      ->get();
    }
    else {
      $pengajuan_mhs = PengajuanMhs::where('status_pengajuan', '>=', 5)
      ->whereIn('status_pengajuan', [5])
      ->get();
    }
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

  public function store (Request $request)
  {
    // $id_pengajuan = $request->id;
    $id_pengajuan       = $request->id_pengajuan;
    $persetujuan        = $request->persetujuan;
    $jenis_pengajuan    = $request->jenis_pengajuan;
    $no_surat_fakultas  = $request->no_surat_fakultas;
    if(session('user_cmode') == config('constants.users.bakhum')) {
      $no_surat_bakhum = $request->no_surat_bakhum;
    }
    $alasan             = $request->alasan;
    // dd($no_surat);
    // dd($id_pengajuan, $persetujuan);
    // dd(count($id_pengajuan));
    // dd(session('user_cmode'));

    if($id_pengajuan === null) {
      return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
    }

    for($i = 0; $i < count($id_pengajuan); $i++) {
      $users = ((session('user_cmode') == config('constants.users.dekanat')));
      // dd($users);

      if(session('user_cmode') == config('constants.users.dekanat') || session('user_cmode') == config('constants.users.wakil_rektor')){
        if($persetujuan[$i] == '1') {
          $persetujuan[$i] = ($users ? config('constants.status.wd_setuju') : config('constants.status.wr_setuju'));
          // dd($persetujuan[$i]);
        }
        else {
          $persetujuan[$i] = ($users ? config('constants.status.wd_tidak_setuju') : config('constants.status.wr_tidak_setuju'));
          // config('constants.status.wd_tidak_setuju');
        }
      }
      elseif(session('user_cmode') == config('constants.users.fakultas')) {
          // dd($surat);
        if($no_surat_fakultas[$i] === null) {
          return redirect()->back()->with('toast_error', 'Ups! Nomor surat masih kosong!');
        }
        else {
          $persetujuan[$i] = config('constants.status.fk_selesai');
        }
      }
      else {
        if($no_surat_bakhum[$i] === null) {
          return redirect()->back()->with('toast_error', 'Ups! Nomor surat masih kosong!');
        }
        else {
          $persetujuan[$i] = config('constants.status.bk_selesai');
        }
      }

      $store = PengajuanMhs::where([
        'id' => $id_pengajuan[$i]
      ])->update([
        'status_pengajuan' => $persetujuan[$i],
        'no_surat_fakultas' => $no_surat_fakultas[$i],
        'no_surat_bakhum'   => $no_surat_bakhum[$i] ?? '',
      ]);

      // dd($store);

      $pengajuan_jenis = PengajuanMhs::where('id', $id_pengajuan[$i])->value('jenis_pengajuan');

      $histories = HistoryPengajuan::updateOrCreate(
        [
          'id_pengajuan' => $id_pengajuan[$i],
          'v_mode' => trim(session('user_cmode'))
        ],
        [
          'jenis_pengajuan' => $pengajuan_jenis,
          'status_pengajuan' => $persetujuan[$i],
          'alasan' => $alasan
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
