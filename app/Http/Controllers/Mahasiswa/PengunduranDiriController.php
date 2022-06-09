<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\PengunduranDiri;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

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

    $status_pengajuan = PengunduranDiri::where('nim', session('user_username'))->get();
    foreach ($status_pengajuan as $status) {
      $status = $status->status_pengajuan;
    }
    // dd($status);
    if(isset($status) !== false && isset($status) !== 4){
      if($status !== 4) {
        return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan pengunduran diri!');
      }
      else if($status_pengajuan->count() >= 2){
        return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengajukan pengunduran diri!');
      }
    }

    $url = env('APP_ENDPOINT_MHS') . session('user_username') . '/' . session('user_token');
    $response = Http::get($url);
    $dataMhs = json_decode($response);

    if ($dataMhs->status == true) {
      foreach ($dataMhs->isi as $mhs)
      {
          $nim = $mhs->nim;
          $nama_lengkap = $mhs->nama;
          $jenis_kelamin = $mhs->kelamin;
          $nama_prodi = $mhs->namaProdi;
          $kode_prodi = $mhs->kodeProdi;
          $nama_fakultas = $mhs->namaFakultas;
          $angkatan = $mhs->angkatan;
          $hp = $mhs->hpm;
      }
    }
    else
    {
        $nim = 'kosong';
        $nama_lengkap = 'kosong';
        $jenis_kelamin = 'kosong';
        $nama_prodi = 'kosong';
        $kode_prodi = 'kosong';
        $nama_fakultas = 'kosong';
        $angkatan = 'kosong';
        $hp = 'kosong';
    }

    $kodeFakultas = substr($kode_prodi, 0, 2);
    $url = env('APP_ENDPOINT_FK') . $kodeFakultas;
    $responseFk = Http::get($url);
    $results = json_decode($responseFk);

    if ($results->status == true) {
      foreach ($results->isi as $fk)
      {
        $kode_fakultas = $fk->kodeFakultas;
      }
    }
    else
    {
      $kode_fakultas = 'kosong';
    }

    $arrData = [
      'title' => 'Form Pengunduran Diri',
      'subtitle' => 'Form Pengunduran Diri',
      'active' => 'Home',
      'user' => $user,
      'mode' => $mode,
      'cmode' => $cmode,
      'md_active' => 'active',

      'nim' => $nim,
      'nama_lengkap' => $nama_lengkap,
      'jenis_kelamin' => $jenis_kelamin,
      'nama_prodi' => $nama_prodi,
      'kode_prodi' => $kode_prodi,
      'nama_fakultas' => $nama_fakultas,
      'kode_fakultas' => $kode_fakultas,
      'angkatan' => $angkatan,
      'hp' => $hp,
      'header' => 'Form Pengunduran Diri',
    ];

    return view('pengunduran_diri.create', $arrData);
  }

  public function store(Request $request)
  {
    PengunduranDiri::create([
      'nim' => $request->nim,
      'nama' => $request->nama,
      'kode_prodi' => $request->kode_prodi,
      'jenis_kelamin' => $request->jenis_kelamin,
      'kode_fakultas' => $request->kode_fakultas,
      'no_telp' => $request->no_telp,
      'email' => $request->email,
      'tahun_angkatan' => $request->tahun_angkatan,
      'semester' => $request->semester,
      'keterangan' => $request->keterangan,
    ]);

    if ($request !== null) {
      return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('success', 'Permohonan Pengunduran Diri Diajukan.');
    } else {
      return back() -> with('error', 'Permohonan Pengunduran Diri Gagal Diajukan.');
    }
  }

  public function show($nim)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $url = env('APP_ENDPOINT_MHS') . session('user_username') . '/' . session('user_token');
    $response = Http::get($url);
    $dataMhs = json_decode($response);

    if ($dataMhs->status == true) {
      foreach ($dataMhs->isi as $mhs)
      {
        $nim = $mhs->nim;
        $nama_lengkap = $mhs->nama;
        $nama_prodi = $mhs->namaProdi;
        $kode_prodi = $mhs->kodeProdi;
        $pa = $mhs->pa;
        $koordProdi = $mhs->koordProdi;
      }
    }
    else
    {
      $nim = 'kosong';
      $nama_lengkap = 'kosong';
      $nama_prodi = 'kosong';
      $kode_prodi = 'kosong';
      $pa = 'kosong';
      $koordProdi = 'kosong';
    }

    $kodeFakultas = substr($kode_prodi, 0, 2);
    $url = env('APP_ENDPOINT_FK') . $kodeFakultas;
    $responseFk = Http::get($url);
    $results = json_decode($responseFk);

    if ($results->status == true) {
      foreach ($results->isi as $fk)
      {
        $wd_1 = $fk->wd1Fakultas;
      }
    }
    else
    {
      $wd_1 = 'kosong';
    }

    $pengunduran_diri = PengunduranDiri::where('nim', $nim)->get();
    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    $arrData = [
      'title' => 'Status Pengunduran Diri',
      'subtitle' => 'Status Pengunduran Diri',
      'active' => 'Home',
      'user' => $user,
      'mode' => $mode,
      'cmode' => $cmode,
      'status_md_active' => 'active',

      'nim' => $nim,
      'nama_lengkap' => $nama_lengkap ,
      'nama_prodi' => $nama_prodi,
      'kode_prodi' => $kode_prodi,
      'pa' => $pa,
      'koordProdi' => $koordProdi,
      'wd_1' => $wd_1,
      'pengunduran_diri' => $pengunduran_diri,
    ];

    return view('pengunduran_diri.status', $arrData);
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
    $md = PengunduranDiri::find($id);
    // dd($md);
    $md->delete();

    // return redirect() -> route('user.index');
    return back()->with('success', 'Pengunduran Diri Batal Diajukan.');
  }
}
