<?php

namespace App\Http\Controllers\Mahasiswa;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengunduranDiri;
use App\Models\PengajuanCuti;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryPengajuan;
use PhpParser\Node\Stmt\TryCatch;

class PengunduranDiriController extends Controller
{
  public function index()
  {
      //
  }

  public function create()
  {
    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode !== '9') {
      return redirect()->to('/home');
    }

    $pengajuan_md = PengunduranDiri::where('nim', session('user_username'))->get();
    foreach ($pengajuan_md as $md) {
      $status_md = $md->status_pengajuan;
    }

    $pengajuan_cuti = PengajuanCuti::where('nim', session('user_username'))->get();
    foreach ($pengajuan_cuti as $cuti) {
      $status_cuti = $cuti->status_pengajuan;
    }

    if(isset($status_md) === false || isset($status_md) !== 4){
      if (isset($status_cuti)) {
        if($status_cuti !== 4 && $status_cuti !== 21) {
          return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan cuti!');
        }
        // else {
        //   return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengundurkan diri dari UNJ!');
        // }
        // return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan cuti!');
      }
      else if(isset($status_md)) {
        if($status_md !== 4) {
          return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan pengunduran diri!');
        }
        else {
          return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengundurkan diri dari UNJ!');
        }
      }
    }

    $arrData = [
      'title'     => 'Form Pengunduran Diri',
      'subtitle'  => 'Form Pengunduran Diri',
      'active'    => 'Home',
      'md_active' => 'active',
    ];

    return view('pengajuan.pengunduran_diri.create', $arrData);
  }

  public function store(Request $request)
  {
    $validator = $request->validate([
      'nim'               => ['required'],
      'nama'              => ['required'],
      'kode_prodi'        => ['required'],
      'jenis_kelamin'     => ['required'],
      'kode_fakultas'     => ['required'],
      'no_telp'           => ['required'],
      'tahun_angkatan'    => ['required'],
      'semester'          => ['required'],
      'keterangan'        => ['required'],
    ]);

    // dd($validator);

    if (!isset($validator)) {
      return back()->with('toast_error', 'Data yang anda masukkan tidak valid!');
    }

    $nim            = $request->nim;
    $nama           = $request->nama;
    $jenis_kelamin  = $request->jenis_kelamin;
    $kode_prodi     = $request->kode_prodi;
    $kode_fakultas  = $request->kode_fakultas;
    $no_telp        = $request->no_telp;
    $tahun_angkatan = $request->tahun_angkatan;
    $semester       = $request->semester;
    $keterangan     = $request->keterangan;

    try {
      DB::beginTransaction();

      $pengunduran_diri = PengunduranDiri::create([
        'nim'             => $request->nim,
        'nama'            => $request->nama,
        'kode_prodi'      => $request->kode_prodi,
        'jenis_kelamin'   => $request->jenis_kelamin,
        'kode_fakultas'   => $request->kode_fakultas,
        'no_telp'         => $request->no_telp,
        'tahun_angkatan'  => $request->tahun_angkatan,
        'semester'        => $request->semester,
        'keterangan'      => $request->keterangan,
      ]);

      $pengunduran_diri = PengunduranDiri::where('nim', session('user_username'))->get();
      // dd($pengunduran_diri);

      foreach ($pengunduran_diri as $pengajuan) {
        $id               = $pengajuan->id;
        $jenis_pengajuan  = $pengajuan->jenis_pengajuan;
      }

      $history                  = new HistoryPengajuan;
      $history->id_pengajuan    = $id;
      $history->jenis_pengajuan = $jenis_pengajuan;
      $history->v_mode          = trim(session('user_cmode'));
      // $history->alasan          = 'setuju';
      $history->save();

      DB::commit();

      return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('success', 'Permohonan Pengunduran Diri Diajukan.');
    }
    catch (Exception $ex) {
      DB::rollBack();
      return back() -> with('error', 'Permohonan Pengunduran Diri Gagal Diajukan.');
    }
  }

  public function show($nim)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $arrData = [
      'title'             => 'Status Pengunduran Diri',
      'subtitle'          => 'Status Pengunduran Diri',
      'active'            => 'Home',
      'status_md_active'  => 'active',
    ];

    return view('pengajuan.pengunduran_diri.status', $arrData);
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
    $md = PengunduranDiri::findOrFail($id);
    // dd($md);
    $md->delete();

    // return redirect() -> route('user.index');
    return back()->with('success', 'Pengunduran Diri Batal Diajukan.');
  }
}
