<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailCutiMhs;

class LecturerController extends Controller
{
  public function index ()
  {
    return view('dashboard_dsn.index', [
      'title' => 'Lecturer',
      'header' => 'Detail Pengajuan Cuti',
      'home' => 'home/dosen',
      // 'mahasiswa' => Lecturer::all(),
      // 'mahasiswa' => Cuti::with(['dosen', 'detailCutiMhs'])->get(),
      'detailCuti' => DetailCutiMhs::all(),

    ]);
  }

  // public function show ()
  // {

  // }
}
