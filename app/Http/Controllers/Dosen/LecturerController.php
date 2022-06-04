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

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($kodeProdi)
  {
    // $dosen = Faculty::where('nidn', $kodeProdi)->first();
    $prodi = StudyProgram::where('kodeProdi', $kodeProdi)->first();
    return view('dashboard_dsn.index', [
      'title' => 'Dosen',
      'prodi' => $prodi,
      'header' => 'Selamat Datang ' . $prodi->koordProdi . ' '. $prodi->namaProdi,
    ]);
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

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }
}
