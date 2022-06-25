<?php

namespace App\Helpers;

use App\Models\BukaPeriode;
use Illuminate\Support\Facades\DB;

class Functions {
  public static function pengajuan($semester)
  {
    $pengajuan = DB::table('pengajuan_mhs')
    ->where('kode_prodi','like',trim(session('user_unit')).'%')
    ->where('semester',trim($semester))
    ->get();

    return $pengajuan;
  }
}
