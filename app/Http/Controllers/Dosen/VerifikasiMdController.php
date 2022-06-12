<?php


namespace App\Http\Controllers\Dosen;

use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengunduranDiri;
use App\Models\PengajuanCuti;
use App\Models\HistoryPengajuan;

class VerifikasiMdController extends Controller
{
  public function index ()
  {
    $user = session('user_name');
    $mode = session('user_mode');
    $cmode = session('user_cmode');

    // dd(session('user_cmode'));

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode !== '8' && $cmode !== '2') {
      return redirect()->to('/home');
    }

    if($cmode === '8') {
      $url = env('APP_ENDPOINT_DSN') . session('user_username') . '/' . session('user_token');
      $response = Http::get($url);
      $data = json_decode($response);

      if ($data->status == true) {
        foreach ($data->isi as $dsn)
        {
          $kode_prodi = $dsn->prodi;
        }
      }

      $prodi = env('APP_ENDPOINT_PRODI') . $kode_prodi;
      $responsePr = Http::get($prodi);
      $dataProdi = json_decode($responsePr);

      if ($dataProdi->status == true) {
        foreach ($dataProdi->isi as $prodi)
        {
          $nama_prodi = $prodi->namaProdi;
        }
      }
    }
    else {
      $url = env('APP_ENDPOINT_PRODI') . session('user_unit');
      $response = Http::get($url);
      $data = json_decode($response);

      if ($data->status == true) {
        foreach ($data->isi as $prodi)
        {
          $nama_prodi = $prodi->namaProdi;
          $kode_prodi = $prodi->kodeProdi;
        }
      }
    }

    $kodeFakultas = substr($kode_prodi, 0, 2);
    $url = env('APP_ENDPOINT_FK') . $kodeFakultas;
    $responseFk = Http::get($url);
    $results = json_decode($responseFk);

    if ($results->status == true) {
      foreach ($results->isi as $fk)
      {
        $nama_fakultas = $fk->namaFakultas;
      }
    }

    if($cmode === '8') {
      $pengunduran_diri = PengunduranDiri::where('kode_prodi', 'like', $kode_prodi)
      ->where('status_pengajuan','0')
      ->orWhere('status_pengajuan','21')
      ->get();

      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', 'like', $kode_prodi)
      ->where('status_pengajuan', '0')
      ->orWhere('status_pengajuan','21')
      ->get();

      $count_cuti = $pengajuan_cuti->count('id');
      $count_md   = $pengunduran_diri->count('id');
    }
    else {
      $pengunduran_diri = PengunduranDiri::where('kode_prodi', 'like', $kode_prodi)
      ->where('status_pengajuan','1')
      ->orWhere('status_pengajuan','22')
      ->get();

      $pengajuan_cuti = PengajuanCuti::where('kode_prodi', 'like', $kode_prodi)
      ->where('status_pengajuan','2')
      ->orWhere('status_pengajuan','22')
      ->get();

      $count_cuti = $pengajuan_cuti->count('id');
      $count_md   = $pengunduran_diri->count('id');
    }

    $arrData = [
      'title' => 'Data Pengunduran Diri',
      'subtitle' => 'Data Pengunduran Diri',
      'modal_title' => 'Detail Pengunduran Diri',
      'active' => 'Home',
      'user' => $user,
      'mode' => $mode,
      'cmode' => $cmode,
      'data_md_active' => 'active',

      'pengunduran_diri' => $pengunduran_diri,
      'nama_fakultas' => $nama_fakultas,
      'nama_prodi' => $nama_prodi,
      'count_cuti'        => $count_cuti,
      'count_md'          => $count_md,
    ];

    return view('verifikasi_dsn.verifikasi_md', $arrData);
  }

  public function store(Request $request)
  {
    $nim                  = $request->nim;
    $status_persetujuan   = $request->status_persetujuan;
    $jenis_pengajuan      = $request->jenis_pengajuan;
    $alasan               = $request->alasan;

    // dd($jenis_pengajuan);

    try {
      DB::beginTransaction();

      if(session('user_cmode') == '8') {
        if ($status_persetujuan == '1'){
          $status_pengajuan = '1';
        }
        elseif ($status_persetujuan == '2'){
          $status_pengajuan = '21';
        }
        else{
          return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
        }
      } else {
        if ($status_persetujuan == '1'){
          $status_pengajuan = '2';
        }
        elseif ($status_persetujuan == '2'){
          $status_pengajuan = '22';
        }
        else{
          return redirect()->back()->with('toast_error', 'Belum Ada Pilihan Status Persetujuan');
        }
      }

      $store = PengunduranDiri::where([
        'nim'               => $nim,
      ])->update([
        'status_pengajuan'  => $status_pengajuan
      ]);

      // dd($store);
      $pengunduran_diri = PengunduranDiri::where('jenis_pengajuan', $jenis_pengajuan)->get();

      foreach($pengunduran_diri as $pengajuan){
        $id = $pengajuan->id;
      }


      $history = HistoryPengajuan::updateOrCreate (
        [
          'id_pengajuan'      => $id,
          'v_mode'            => trim(session('user_cmode'))
        ],
        [
          'jenis_pengajuan'   => $jenis_pengajuan,
          'status_pengajuan'  => $status_pengajuan,
          'alasan'            => $alasan,
        ]
      );

      DB::commit();

      return redirect()->back()->with('success', 'Data Persetujuan Berhasil Diupload');
    }
    catch (Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('toast_error', 'Terjadi kesalahan saat mengunggah data');
    }
  }


  public function show($kodeFakultas)
  {

  }

  public function edit($id)
  {
      //
  }

  public function update(Request $request, $id)
  {
      //
  }

  public function destroy($id)
  {
      //
  }
}
