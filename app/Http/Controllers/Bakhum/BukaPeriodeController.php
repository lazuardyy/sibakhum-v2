<?php

namespace App\Http\Controllers\Bakhum;

use Exception;
use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanCuti;
use App\Models\PengunduranDiri;
use App\Models\HistoryPengajuan;
use App\Models\BukaPeriode;
use PhpParser\Node\Stmt\TryCatch;

class BukaPeriodeController extends Controller
{
  public function index ()
  {
    $user   = session('user_name');
    $mode   = session('user_mode');
    $cmode  = session('user_cmode');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    // elseif($cmode !== config('constants.users.bakhum')) {
    //   return redirect()->to('/home');
    // }

    $periode = DB::table('ref_periode')->get();

    $aktif_periode = BukaPeriode::where('aktif', '1')->first();

    if ($aktif_periode){
      $semester = $aktif_periode->semester;
    }else{
      $semester = "";
    }

    $badges = Functions::pengajuan($semester);
    // dd($badges);


    $arrData = [
      'title'               => 'Buka Periode Pengajuan Cuti',
      'subtitle'            => 'Buka Periode Pengajuan Cuti',
      'modal_title'         => 'Detail Pengajuan Cuti',
      'active'              => 'Home',
      'buka_periode_active' => 'active',

      'periode'             => $periode,
    ];

    return view('bakhum.buka_periode', $arrData);
  }

  public function activate (Request $request)
  {
    $id_periode = $request->id_periode;
    $status_aktif = ($request->aktifCheck == '1') ? '0' : '1';

    try {
        DB::beginTransaction();
        BukaPeriode::where([
            'id'        => $id_periode
        ])->update([
            'aktif'  => $status_aktif
        ]);

        DB::commit();
        if ($status_aktif == '1'){
            return redirect()->route('periode.index')->with('toast_success', 'Activated Semester berhasil');
        }
        else{
            return redirect()->route('periode.index')->with('toast_success', 'Deactivated Semester berhasil');
        }


    }catch (Exception $ex) {
        DB::rollBack();
        return redirect()->route('periode.index')->with('toast_error', 'Error : ' . $ex->getMessage());
    }
  }

  public function store (Request $request)
  {
    $credentials = $request->validate([
      'semester'          => ['required'],
      'des_semester'      => ['required'],
      'start_date'        => ['required','date'],
      'end_date'          => ['required','date']
    ]);

    $semester     = $request->semester;
    $des_semester = $request->des_semester;
    $start_date   = $request->start_date;
    $end_date     = $request->end_date;
    $status_aktif = '0';

    $start = date("Y-m-d H:i:s", strtotime($start_date));
    $end = date("Y-m-d H:i:s", strtotime($end_date));

    try {
        DB::beginTransaction();

        $store = BukaPeriode::updateOrCreate (
            [
              'semester'      => $semester
            ],
            [
              'semester'      => $semester,
              'des_semester'  => $des_semester,
              'start_date'    => $start,
              'end_date'      => $end,
              'aktif'         => $status_aktif
            ]
        );

        // dd($store);

        DB::commit();
        return redirect()->route('periode.index')->with('toast_success', 'Simpan Semester berhasil');

    }catch (Exception $ex) {
        DB::rollBack();
        return redirect()->route('periode.index')->with('toast_error', 'Gagal simpan semester');
    }
  }

  public function edit ($id)
  {
    $data = BukaPeriode::findOrFail($id);
    // $data->start = date("d/m/y H:i A",$data->start_date);
    // $data->end = date("d/m/y H:i A",$data->end_date);

    return json_encode($data);
  }

  public function destroy ($id)
  {
    try {
        DB::beginTransaction();
        BukaPeriode::where([
            'id'        => $id
        ])->delete();

        DB::commit();
        return redirect()->route('periode.index')->with('toast_success', 'Hapus Semester berhasil');

    }catch (Exception $ex) {
        DB::rollBack();
        return redirect()->route('periode.index')->with('toast_error', 'Gagal hapus semester');
    }
  }
}
