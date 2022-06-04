<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudyProgramController extends Controller
{
  public function index ()
  {
    $data = Http::get('http://103.8.12.212:36880/siakad_api/api/as400/programStudi/All');
    return view('test', ['data' => $data]);
  }
}
