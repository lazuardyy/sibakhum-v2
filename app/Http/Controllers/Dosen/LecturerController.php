<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyProgram;


class LecturerController extends Controller
{
  public function index ()
  {
    // return view('dashboard_dsn.index', [
    //   'title' => 'Lecturer',
    //   'header' => 'Detail Pengajuan Cuti',
    //   'home' => 'home/dosen',
    //   'detailCuti' => DetailCutiMhs::all(),
    // ]);
  }
  public function create()
  {
      //
  }

  public function store(Request $request)
  {
      //
  }

  public function show($kode_prodi)
  {

    $prodi = StudyProgram::where('kode_prodi', base64_decode($kode_prodi))->first();
    return view('dashboard_dsn.index', [
      'title' => 'Dosen',
      'prodi' => $prodi,
      'header' => 'Selamat Datang ' . $prodi->jabatan . ' '. $prodi->namaProdi,
    ]);
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
