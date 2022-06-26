<?php

namespace App\Http\Controllers\Fakultas;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengunduranDiri;
use App\Models\PengajuanMhs;
use App\Mail\Pengajuan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
    elseif($cmode !== config('constants.users.fakultas')) {
      return redirect()->to('/home');
    }

    $pengajuan_md = PengunduranDiri::where('nim', session('user_username'))->get();
    foreach ($pengajuan_md as $md) {
      $status_md = $md->status_pengajuan;
    }

    $pengajuan_cuti = PengajuanMhs::where('nim', session('user_username'))->get();
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
      'pa'                => ['required'],
      'nama'              => ['required'],
      'jenis_kelamin'     => ['required'],
      'nama_prodi'        => ['required'],
      'kode_prodi'        => ['required'],
      'nama_fakultas'     => ['required'],
      'kode_fakultas'     => ['required'],
      'email'             => ['required'],
      'no_telp'           => ['required'],
      'tahun_angkatan'    => ['required'],
      'semester'          => ['required'],
      'keterangan'        => ['required'],
    ]);

    $nim            = $request->nim;
    $nama           = $request->nama;
    $pa             = $request->pa;
    $jenis_kelamin  = $request->jenis_kelamin;
    $nama_prodi     = $request->nama_prodi;
    $kode_prodi     = $request->kode_prodi;
    $nama_fakultas  = $request->nama_fakultas;
    $kode_fakultas  = $request->kode_fakultas;
    $email          = $request->email;
    $no_telp        = $request->no_telp;
    $tahun_angkatan = $request->tahun_angkatan;
    $semester       = $request->semester;
    $keterangan     = $request->keterangan;


    $pengajuan_md = PengunduranDiri::updateOrcreate([
      'nim'             => $nim,
      'nama'            => $nama,
      'pa'              => $pa,
      'jenis_kelamin'   => $jenis_kelamin,
      'nama_prodi'      => $nama_prodi,
      'kode_prodi'      => $kode_prodi,
      'nama_fakultas'   => $nama_fakultas,
      'kode_fakultas'   => $kode_fakultas,
      'email'           => $email,
      'no_telp'         => $no_telp,
      'tahun_angkatan'  => $tahun_angkatan,
      'semester'        => $semester,
      'keterangan'      => $keterangan,
    ]);

    // dd($validator);
    $pengajuanMd = PengunduranDiri::where('nim', $nim)->get();
    $pengajuanMd = json_decode($pengajuanMd);

    Mail::to($email)->send(new Pengajuan($pengajuanMd));

    // $data = $request->all();

    return response()->json(['success' => 'Data submitted successfully']);
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
    $no_telp        = $request->no_telp;
    $tahun_angkatan = $request->tahun_angkatan;
    $semester       = $request->semester;
    $keterangan     = $request->keterangan;

    $update = PengunduranDiri::where('id', $id)->update([
      'no_telp'         => $no_telp,
      'tahun_angkatan'  => $tahun_angkatan,
      'semester'        => $semester,
      'keterangan'      => $keterangan,
    ]);

    if ($update) {
      return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('success', 'Data berhasil diubah.');
    }
    else {
      return back()->with('toast_error', 'Data gagal diubah.');
    }
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
