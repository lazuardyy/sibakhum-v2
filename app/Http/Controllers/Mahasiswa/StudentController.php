<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\DetailCutiMhs;
use App\Models\Lecturer;
use App\Models\Faculty;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    $arrData = [
      'title'         => 'Home',
      'active'        => 'home',
      'user'          => $user,
      'mode'          => $mode,
      'cmode'          => $cmode,
      'subtitle'      => 'Dashboard',
      'home_active'   => 'active',
      // 'students' => Student::all(),
    ];

    return view('dashboard_mhs.index', $arrData);
  }

  public function status ($nim) {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $url = env('APP_ENDPOINT_MHS') . session('user_username') . '/' . session('user_token');
    $response = Http::get($url);
    $dataMhs = json_decode($response);

    if ($dataMhs->status == true) {
      foreach ($dataMhs->isi as $mhs)
      {
          $pa = $mhs->pa;
          $koordProdi = $mhs->koordProdi;
          $kode_prodi = $mhs->kodeProdi;
      }
    }
    else
    {
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

    $arrData = [
      'pa' => $pa,
      'koordProdi' => $koordProdi,
      'wd_1' => $wd_1,
      'header' => 'Status Pengajuan Cuti',
      'students' => Student::where('nim', base64_decode($nim))->get(),
    ];

    return view('crud_cuti_mhs.status', $arrData);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
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
      'nim' => $nim,
      'nama_lengkap' => $nama_lengkap,
      'jenis_kelamin' => $jenis_kelamin,
      'nama_prodi' => $nama_prodi,
      'kode_prodi' => $kode_prodi,
      'nama_fakultas' => $nama_fakultas,
      'kode_fakultas' => $kode_fakultas,
      'angkatan' => $angkatan,
      'hp' => $hp,
    ];

    return view('crud_cuti_mhs.create', $arrData);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // $validateData = $request->validate([
    //   'nim' => ['required', 'unique:cutis'],
    //   'nama' => ['required', 'string', 'max:255'],
    //   'prodi' => ['required', 'string', 'max:255'],
    //   'jenis_kelamin' => ['required'],
    //   'fakultas' => ['required'],
    //   'no_telp' => ['required'],
    //   'email' => ['required', 'email:dns'],
    //   'tahun_angkatan' => ['required'],
    //   'keterangan' => ['required', 'string'],
    // ]);

    Student::create([
      'nim' => $request->nim,
      'nama' => $request->nama,
      'kodeProdi' => $request->kodeProdi,
      'jenis_kelamin' => $request->jenis_kelamin,
      'kodeFakultas' => $request->kodeFakultas,
      'no_telp' => $request->no_telp,
      'email' => $request->email,
      'tahun_angkatan' => $request->tahun_angkatan,
      'semester' => $request->semester,
      'keterangan' => $request->keterangan,
    ]);

    if ($request !== null) {
      return back() -> with('success', 'Permohonan Cuti Diajukan.');
    } else {
      return back() -> with('error', 'Permohonan Cuti Gagal Diajukan.');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }
}
