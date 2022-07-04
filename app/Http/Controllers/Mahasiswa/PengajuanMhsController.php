<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\PengajuanMhs;
use App\Models\PengunduranDiri;
use App\Models\HistoryPengajuan;
use App\Models\BukaPeriode;
use App\Mail\Pengajuan;
use PhpParser\Node\Stmt\TryCatch;
use Exception;

class PengajuanMhsController extends Controller
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

    $periode = BukaPeriode::checkOpenPeriode();
    // dd($periode->semester);

    if ($periode === null || $periode->aktif === '0') {
      return redirect()->to('/home')->with('toast_error', 'Periode pengajuan cuti belum dibuka!');
    }


    $pengajuan_mhs = PengajuanMhs::where('nim', session('user_username'))->get();
    foreach ($pengajuan_mhs as $cuti) {
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
          return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan cuti!');
        }
        else if($pengajuan_mhs->count() >= 2)
        {
          return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengajukan permohonan cuti sebanyak 2x!');
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
      'pa'                => ['required'],
      'nama'              => ['required'],
      'jenis_kelamin'     => ['required'],
      'nama_prodi'        => ['required'],
      'kode_prodi'        => ['required'],
      'nama_fakultas'     => ['required'],
      'jenjang'           => ['required'],
      'kode_fakultas'     => ['required'],
      'email'             => ['required'],
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
    $pa             = $request->pa;
    $jenis_kelamin  = $request->jenis_kelamin;
    $nama_prodi     = $request->nama_prodi;
    $kode_prodi     = $request->kode_prodi;
    $nama_fakultas  = $request->nama_fakultas;
    $kode_fakultas  = $request->kode_fakultas;
    $jenjang        = $request->jenjang;
    $email          = $request->email;
    $no_telp        = $request->no_telp;
    $tahun_angkatan = $request->tahun_angkatan;
    $semester       = $request->semester;
    $keterangan     = $request->keterangan;
    $jenis_pengajuan     = $request->jenis_pengajuan;
    $status_pengajuan = $request->status_pengajuan;
    // if($request->status_pengajuan !== null) {
    // }

    // dd($request->status_pengajuan);
    // $status_pengajuan     = (($request->status_pengajuan !== null) ? $request->status_pengajuan : '');
    // dd($status_pengajuan);

    // if($jenis_pengajuan !== null) {
    //   $jenis_pengajuan;
    // }

    try {
      DB::beginTransaction();

      $pengajuan_mhs = PengajuanMhs::updateOrcreate([
        'nim'             => $nim,
        'nama'            => $nama,
        'pa'              => $pa,
        'jenis_kelamin'   => $jenis_kelamin,
        'nama_prodi'      => $nama_prodi,
        'kode_prodi'      => $kode_prodi,
        'nama_fakultas'   => $nama_fakultas,
        'kode_fakultas'   => $kode_fakultas,
        'jenjang'         => $jenjang,
        'email'           => $email,
        'no_telp'         => $no_telp,
        'tahun_angkatan'  => $tahun_angkatan,
        'semester'        => $semester,
        'keterangan'      => $keterangan,
        'jenis_pengajuan'      => $jenis_pengajuan,
        'status_pengajuan' => $status_pengajuan
        // (($status_pengajuan !== null) ? 'status_pengajuan' : '') => (($status_pengajuan !== null) ? $status_pengajuan : '')
      ]);
      // dd($pengajuanMhs);

      $pengajuanMhs = PengajuanMhs::where('nim', $nim)->get();

      foreach ($pengajuanMhs as $pengajuan) {
        $id = $pengajuan->id;
        $jenis_pengajuan = $pengajuan->jenis_pengajuan;
      }

      $history                  = new HistoryPengajuan;
      $history->id_pengajuan    = $id;
      $history->jenis_pengajuan = $jenis_pengajuan;
      $history->v_mode          = trim(session('user_cmode'));
      // $history->alasan          = 'setuju';
      $history->save();

      $pengajuanMhs = json_decode($pengajuanMhs);
      Mail::to($email)->send(new Pengajuan($pengajuanMhs));

      DB::commit();

      if($jenis_pengajuan !== 2) {
        return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('success', 'Permohonan Cuti Diajukan.');
      }
      else {
        return response()->json(['success' => 'Data submitted successfully']);
      }

    }
    catch (Exception $ex) {
      DB::rollBack();
      return back()->with('toast_error', 'Permohonan cuti gagal diajukan, terjadi kesalahan!');
    }
  }

  public function show($nim)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    // $pengajuanCuti = PengajuanMhs::where('nim', base64_decode($nim))->get();
    // $pengajuanCuti = json_decode($pengajuanCuti);
    // Mail::to('muklasnurardiansyah@gmail.com')->send(new Pengajuan($pengajuanCuti));

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
    $no_telp        = $request->no_telp;
    $tahun_angkatan = $request->tahun_angkatan;
    $semester       = $request->semester;
    $keterangan     = $request->keterangan;

    $update = PengajuanMhs::where('id', $id)->update([
      'no_telp'         => $no_telp,
      'tahun_angkatan'  => $tahun_angkatan,
      'semester'        => $semester,
      'keterangan'      => $keterangan,
    ]);

    if ($update) {
      return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('success', 'Data berhasil diubah.');
    }
    else {
      return back()->with('toast_error', 'Data gagal diubah.');
    }

  }

  public function destroy($id)
  {
    $cuti = PengajuanMhs::findOrFail($id);
    // dd($cuti);
    $cuti->delete();
    return back()->with('success', 'Pengajuan Cuti Batal Diajukan.');
  }
}
