<?php

namespace App\Http\Controllers\Mahasiswa;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;
use App\Models\HistoryPengajuan;
use PhpParser\Node\Stmt\TryCatch;

class PengajuanCutiController extends Controller
{
  public function index()
  {

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
    // dd($cmode);

    $pengajuan_cuti = PengajuanCuti::where('nim', session('user_username'))->get();
    foreach ($pengajuan_cuti as $cuti) {
      $status_cuti = $cuti->status_pengajuan;
    }

    $pengajuan_md = PengunduranDiri::where('nim', session('user_username'))->get();
    foreach ($pengajuan_md as $md) {
      $status_md = $md->status_pengajuan;
    }

    // dd(isset($status_md) === true);

    if(isset($status_cuti) === false || isset($status_cuti) !== 4){
      if (isset($status_md))
      {
        if($status_md !== 4)
        {
          return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan pengunduran diri!');
        }
        else {
          return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengundurkan diri dari UNJ!');
        }
      }
      else if(isset($status_cuti) === true)
      {
        if($status_cuti !== 4 && $status_cuti !== 21)
        {
          return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan cuti!');
        }
        else if($pengajuan_cuti->count() >= 2)
        {
          return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengajukan permohonan cuti sebanyak 2x!');
        }
      }
    }

    $arrData = [
      'title'         => 'Form Pengajuan Cuti',
      'subtitle'      => 'Form Pengajuan Cuti',
      'active'        => 'Home',
      'cuti_active'   => 'active',
    ];

    return view('pengajuan.pengajuan_cuti.create', $arrData);
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

      $pengajuan_cuti = PengajuanCuti::updateOrcreate([
        'nim'             => $nim,
        'nama'            => $nama,
        'jenis_kelamin'   => $jenis_kelamin,
        'kode_prodi'      => $kode_prodi,
        'kode_fakultas'   => $kode_fakultas,
        'no_telp'         => $no_telp,
        'tahun_angkatan'  => $tahun_angkatan,
        'semester'        => $semester,
        'keterangan'      => $keterangan,
      ]);

      $pengajuan_cuti = PengajuanCuti::where('nim', session('user_username'))->get();
      // dd($pengajuan_cuti);

      foreach ($pengajuan_cuti as $pengajuan) {
        $id = $pengajuan->id;
        $jenis_pengajuan = $pengajuan->jenis_pengajuan;
      }

      $history                  = new HistoryPengajuan;
      $history->id_pengajuan    = $id;
      $history->jenis_pengajuan = $jenis_pengajuan;
      $history->v_mode          = trim(session('user_cmode'));
      // $history->alasan          = 'setuju';
      $history->save();

      DB::commit();
      return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('success', 'Permohonan Cuti Diajukan.');

    }
    catch (Exception $ex) {
      DB::rollBack();
      return back()->with('toast_error', 'Permohonan Cuti Gagal Diajukan.');
    }
  }

  public function show($nim)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $arrData = [
      'title'               => 'Status Pengajuan Cuti',
      'active'              => 'Home',
      'status_cuti_active'  => 'active',
    ];

    // dd($arrData);

    return view('pengajuan.pengajuan_cuti.status', $arrData);
  }

  public function edit($id)
  {

  }

  public function update(Request $request, $id)
  {


  }

  public function destroy($id)
  {
    $cuti = PengajuanCuti::findOrFail($id);
    // dd($cuti);
    $cuti->delete();
    return back()->with('success', 'Pengajuan Cuti Batal Diajukan.');
  }
}
