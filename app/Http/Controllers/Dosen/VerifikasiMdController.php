<?php


namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
    elseif($cmode !== '8') {
      return redirect()->to('/home');
    }

    $pengajuan = DB::table('pengunduran_diri')
    ->where('kode_prodi','like',trim(session('user_unit')).'%')
    // ->where('semester',trim($semester))
    // ->where('status_pengajuan','2')
    // ->orWhere('status_pengajuan','22')
    ->get();
    // dd($pengajuan);

    // $status_pengajuan = PengajuanCuti::where('nim', session('user_username'))->get();
    // foreach ($status_pengajuan as $status) {
    //   $status = $status->status_pengajuan;
    // }
    // dd($status_pengajuan->count());
    // dd(isset($status));

    // if(isset($status) !== false && isset($status) !== 4){
    //   if($status !== 4) {
    //     return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan cuti!');
    //   }
    //   else if($status_pengajuan->count() >= 2){
    //     return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengajukan permohonan cuti sebanyak 2x!');
    //   }
    // }

    // $url = env('APP_ENDPOINT_MHS') . session('user_username') . '/' . session('user_token');
    // $response = Http::get($url);
    // $dataMhs = json_decode($response);

    // if ($dataMhs->status == true) {
    //   foreach ($dataMhs->isi as $mhs)
    //   {
    //     $nim = $mhs->nim;
    //     $nama_lengkap = $mhs->nama;
    //     $jenis_kelamin = $mhs->kelamin;
    //     $nama_prodi = $mhs->namaProdi;
    //     $kode_prodi = $mhs->kodeProdi;
    //     $nama_fakultas = $mhs->namaFakultas;
    //     $angkatan = $mhs->angkatan;
    //     $hp = $mhs->hpm;
    //   }
    // }
    // else
    // {
    //   $nim = 'kosong';
    //   $nama_lengkap = 'kosong';
    //   $jenis_kelamin = 'kosong';
    //   $nama_prodi = 'kosong';
    //   $kode_prodi = 'kosong';
    //   $nama_fakultas = 'kosong';
    //   $angkatan = 'kosong';
    //   $hp = 'kosong';
    // }

    // $kodeFakultas = substr($kode_prodi, 0, 2);
    // $url = env('APP_ENDPOINT_FK') . $kodeFakultas;
    // $responseFk = Http::get($url);
    // $results = json_decode($responseFk);

    // if ($results->status == true) {
    //   foreach ($results->isi as $fk)
    //   {
    //     $kode_fakultas = $fk->kodeFakultas;
    //   }
    // }
    // else
    // {
    //   $kode_fakultas = 'kosong';
    // }

    $arrData = [
      'title' => 'Data Pengunduran Diri',
      'subtitle' => 'Data Pengunduran Diri',
      'active' => 'Home',
      'user' => $user,
      'mode' => $mode,
      'cmode' => $cmode,
      'data_md_active' => 'active',

      // 'nim' => $nim,
      // 'nama_lengkap' => $nama_lengkap,
      // 'jenis_kelamin' => $jenis_kelamin,
      // 'nama_prodi' => $nama_prodi,
      // 'kode_prodi' => $kode_prodi,
      // 'nama_fakultas' => $nama_fakultas,
      // 'kode_fakultas' => $kode_fakultas,
      // 'angkatan' => $angkatan,
      // 'hp' => $hp,
    ];

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
