<?php

namespace App\Http\Controllers\Koorprodi;

use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanCuti;
use App\Models\HistoryPengajuan;

class VerifikasiKoorprodiController extends Controller
{
  public function index ()
  {
    return view('verifikasi_dsn.verifikasi_cuti');
  }
}
