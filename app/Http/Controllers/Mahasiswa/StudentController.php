<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\DetailCutiMhs;
use App\Models\Lecturer;

class StudentController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('dashboard_mhs.index', [
      'title' => 'Mahasiswa',
      'home' => 'home/mahasiswa',
    ]);
  }

  public function status () {
    return view('dashboard_mhs.status', [
      'title' => 'Status',
      'header' => 'Status Pengajuan',
      // 'cutiMhs' => Cuti::with(['dosen', 'detailCutiMhs'])->get(),
      'detailCuti' => DetailCutiMhs::all(),
      'dosens' => Lecturer::with(['detailCutiMhs'])->get(),
      // 'persetujuan' => Cuti::with('dosen')->get(),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('crud_cuti_mhs.create', [
      'title' => 'Pengajuan Cuti',
      'header' => 'Pengajuan Cuti',
      // 'fakultas' => Cuti::all()
    ]);
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
      'prodi' => $request->prodi,
      'jenis_kelamin' => $request->jenis_kelamin,
      'faculty_id' => $request->faculty_id,
      'no_telp' => $request->no_telp,
      'email' => $request->email,
      'tahun_angkatan' => $request->tahun_angkatan,
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
      //
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
