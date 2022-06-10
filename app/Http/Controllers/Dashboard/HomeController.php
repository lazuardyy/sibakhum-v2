<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PengajuanCuti;

class HomeController extends Controller
{
  public function index ()
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
  }

  $user = session('user_name');
  $mode = session('user_mode');
  $cmode = session('user_cmode');

  $arrData = [
    'title'           => 'Dashboard',
    'active'          => 'Home',
    'user'            => $user,
    'mode'            => $mode,
    'cmode'           => $cmode,
    'home_active'     => 'active',
    'pengajuan_cuti'  => collect(PengajuanCuti::where('kode_prodi', 'like', trim(session('user_unit')) . '%')->get())
  ];

  $cuti = collect(PengajuanCuti::where('kode_prodi', 'like', trim(session('user_unit')) . '%')->get());

  // dd($cuti);

    return view('home.index', $arrData);
  }
}
