<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\MDStudent;

class MDStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('crud_md_mhs.create', [
        'title' => 'Pengajuan Cuti',
        'header' => 'Form Pengunduran Diri',
        'faculties' => Faculty::all(),
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
      MDStudent::create([
        'nim' => $request->nim,
        'nama' => $request->nama,
        'kodeProdi' => $request->kodeProdi,
        'jenis_kelamin' => $request->jenis_kelamin,
        'kodeFakultas' => $request->kodeFakultas,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
        'tahun_angkatan' => $request->tahun_angkatan,
        'keterangan' => $request->keterangan,
      ]);

      if ($request !== null) {
        return back() -> with('success', 'Permohonan Pengundurann Diajukan.');
      } else {
        return back() -> with('error', 'Permohonan Pengunduran Diri Gagal Diajukan.');
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
