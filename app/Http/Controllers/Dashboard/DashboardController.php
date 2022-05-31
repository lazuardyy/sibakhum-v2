<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecturer;
// use App\Models\Cuti;
use App\Models\DetailCutiMhs;

class DashboardController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
      return view('partials.welcome', [
          'title' => 'Home',
      ]);
  }

  public function fakultas () {
    return view('dashboard.fakultas', [
      'title' => 'Fakultas',
    ]);
  }

  public function universitas () {
    return view('dashboard.universitas', [
      'title' => 'Universitas',
    ]);
  }
}
