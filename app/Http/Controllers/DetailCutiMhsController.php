<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailCutiMhs;

class DetailCutiMhsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      // return view('crud_cutis.create', [
      //     'title' => 'Cuti'
      // ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // return view('crud_cuti_mhs.create', [
    //   'title' => 'Pengajuan Cuti'
    // ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    DetailCutiMhs::create([
      'status_persetujuan_pa' => $request -> status_persetujuan_pa,
      // 'status_persetujuan_koorprodi' => $request -> nim,
      // 'status_persetujuan_koorprodi' => $request -> nim,
    ]);

    if ($request !== null) {
      return back() -> with('success', 'Permohonan Cuti Disetujui.');
    } else {
      return back() -> with('error', 'Permohonan Cuti Gagal Disimpan.');
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
