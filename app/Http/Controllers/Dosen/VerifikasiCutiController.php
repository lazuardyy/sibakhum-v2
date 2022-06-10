<?php


namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanCuti;

class VerifikasiCutiController extends Controller
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
    elseif($cmode !== '8') {
      return redirect()->to('/home');
    }

    $url = env('APP_ENDPOINT_DSN') . session('user_username') . '/' . session('user_token');
    $response = Http::get($url);
    $dataDsn = json_decode($response);

    if ($dataDsn->status == true) {
      foreach ($dataDsn->isi as $dsn)
      {
        $kode_prodi = $dsn->prodi;
      }
    }

    // $pengajuan_cuti = DB::table('pengajuan_cuti')
    // ->where('kode_prodi','like', $kode_prodi)
    // ->where('status_pengajuan','<=','0')
    // // ->orWhere('status_pengajuan','22')
    // ->get();
    $pengajuan_cuti = PengajuanCuti::where('kode_prodi', 'like', $kode_prodi)->get();
    // dd($pengajuan_cuti);

    // foreach($pengajuan_cuti as $pengajuan)
    // {
    //   $nim = $pengajuan->nim;
    //   $nama_lengkap = $pengajuan->nama;
    //   $jenis_kelamin = $pengajuan->jenis_kelamin;
    //   // $nama_prodi = $pengajuan->nama_prodi;
    //   $kode_prodi = $pengajuan->kode_prodi;
    //   // $nama_fakultas = $pengajuan->nama_fakultas;
    //   $kode_fakultas = $pengajuan->kode_fakultas;
    //   $angkatan = $pengajuan->tahun_angkatan;
    //   $hp = $pengajuan->no_telp;
    //   $keterangan = $pengajuan->keterangan;
    //   $jenis_pengajuan = $pengajuan->keterangan;
    // }


    $arrData = [
      'title' => 'Data Pengajuan Cuti',
      'subtitle' => 'Data Pengajuan Cuti',
      'active' => 'Home',
      'user' => $user,
      'mode' => $mode,
      'cmode' => $cmode,
      'data_cuti_active' => 'active',

      'pengajuan_cuti' => $pengajuan_cuti,

      // 'nim' => $nim,
      // 'nama_lengkap' => $nama_lengkap,
      // 'jenis_kelamin' => $jenis_kelamin,
      // // 'nama_prodi' => $nama_prodi,
      // 'kode_prodi' => $kode_prodi,
      // // 'nama_fakultas' => $nama_fakultas,
      // 'kode_fakultas' => $kode_fakultas,
      // 'angkatan' => $angkatan,
      // 'hp' => $hp,
      // 'keterangan' => $keterangan,
      // 'jenis_pengajuan' => $jenis_pengajuan,
    ];

    // dd($arrData);

    return view('verifikasi_dsn.index', $arrData);
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
    public function show($kodeFakultas)
    {
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
