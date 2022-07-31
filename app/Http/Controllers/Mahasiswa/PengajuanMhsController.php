<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\PengajuanMhs;
use App\Models\PengunduranDiri;
use App\Models\HistoryPengajuan;
use App\Models\BukaPeriode;
use App\Mail\Pengajuan;
use PhpParser\Node\Stmt\TryCatch;
use Exception;

class PengajuanMhsController extends Controller
{
  public function create()
  {
    $user  = session('user_name');
    $mode  = session('user_mode');
    $cmode = session('user_cmode');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode !== '9') {
      return redirect()->to('/home');
    }

    // cek periode pengajuan
    $periode = BukaPeriode::checkOpenPeriode();
    $semester = isset($periode) ? $periode->semester : null;

    // cek status beasiswa
    $url_beasiswa = env('APP_ENDPOINT_BEASISWA') . session('user_username') . '/' . $semester . '/' . env('APP_AUTH');

    $status_beasiswa = Http::get($url_beasiswa);
    $status_beasiswa = json_decode($status_beasiswa);

    if($periode === null || $periode->aktif === '0') {
      return redirect()->to('/home')->with('toast_error', 'Periode pengajuan cuti belum dibuka!');
    }
    else
    {
      $status_beasiswa = $status_beasiswa->isi[0];
      // dd($status_beasiswa->beasiswa);

      if($status_beasiswa->beasiswa === 'yes' || $status_beasiswa->kerjasama === 'yes')
      {
        return redirect()->to('/home')->with('toast_error', 'Maaf anda penerima beasiswa!');
      }
    }

    $status_cuti = PengajuanMhs::where('nim', session('user_username'))
    ->where('jenis_pengajuan', 1)
    ->pluck('status_pengajuan');

    // dd($status_cuti);

    $status_md = PengajuanMhs::where('nim', session('user_username'))
    ->where('jenis_pengajuan', 2)
    ->get();

    // set variable mengundurkan diri
    $md_disetujui = null;
    $md_ditolak   = null;
    $md_diproses  = null;

    // set variable pengajuan cuti
    $cuti_dua_kali = array();
    $cuti_ditolak  = null;
    $cuti_diproses = null;

    foreach($status_cuti as $key => $status) {
      if($status == 7) {
        $cuti_dua_kali[] = $status;
      }
      elseif($status < 7) {
        $cuti_diproses = $status;
      }
      else {
        $cuti_ditolak = $status;
      }
    }

    foreach($status_md as $status) {
      if($status->status_pengajuan == 7) {
        $md_disetujui = $status->status_pengajuan;
      }
      elseif($status->status_pengajuan < 7) {
        $md_diproses = $status->status_pengajuan;
      }
      else {
        $md_ditolak = $status->status_pengajuan;
      }
    }


    if($md_disetujui === 7 ) {
      return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengundurkan diri dari UNJ!');
    }
    elseif(count($cuti_dua_kali) === 2) {
      return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengajukan permohonan cuti sebanyak 2x!');
    }
    elseif(($cuti_diproses !== null && $cuti_diproses < 7) || ($md_diproses !== null && $md_diproses < 7)) {
      return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan ' . ($cuti_diproses !== null ? 'cuti' : 'pengunduran diri')) ;
    };

    $datas = array(
      [
        'title' => 'Email',
        'type' => 'email',
        'typeInput' => 'email',
        'placeholder' => 'Masukkan google mail (gmail) kamu',
        'note' => 'Masukkan gmail aktif',
        'value' => '',
      ],
      [
        'title' => 'No. Telp',
        'type' => 'tel',
        'typeInput' => 'no_telp',
        'placeholder' => 'Masukkan nomor telephone',
        'note' => 'Masukkan no telephone aktif',
        'value' => '',
      ],
      [
        'title' => 'Angkatan',
        'type' => 'number',
        'typeInput' => 'tahun_angkatan',
        'placeholder' => '',
        'note' => '',
        'value' => '',
      ],
      [
        'title' => 'Semester',
        'type' => 'number',
        'typeInput' => 'semester',
        'placeholder' => 'Masukkan semester berjalan, contoh : 117',
        'note' => '',
        'value' => '',
      ],
      [
        'title' => 'Keterangan',
        'type' => 'textarea',
        'typeInput' => 'keterangan',
        'placeholder' => 'Jelaskan alasan pengajuan cuti',
        'note' => '',
        'value' => '',
      ],

    );


    $arrData = [
      'title'         => 'Form Pengajuan Cuti',
      'subtitle'      => 'Form Pengajuan Cuti',
      'active'        => 'Home',
      'cuti_active'   => 'active',

      'datas'         => $datas,
    ];

    return view('pengajuan.pengajuan_cuti.create', $arrData);
  }

  public function store(Request $request)
  {
    // return $request->file('upload_file')->store('file_pengajuan');

    $validator = $request->validate([
      'nim'               => ['required'],
      'pa'                => ['required'],
      'nama'              => ['required'],
      'jenis_kelamin'     => ['required'],
      'nama_prodi'        => ['required'],
      'kode_prodi'        => ['required'],
      'nama_fakultas'     => ['required'],
      'kode_fakultas'     => ['required'],
      'jenjang'           => ['required'],
      'email'             => 'required | email:dns',
      'no_telp'           => ['required'],
      'tahun_angkatan'    => ['required'],
      'semester'          => ['required'],
      'keterangan'        => ['required'],
      'upload_file'       => 'file|mimes:pdf, doc, docx|max:2048'
    ]);

    // dd($validator);

    // if (!isset($validator)) {
    //   return back()->with('toast_error', 'Data yang anda masukkan tidak valid!');
    // }

    $nim              = $request->nim;
    $nama             = $request->nama;
    $pa               = $request->pa;
    $jenis_kelamin    = $request->jenis_kelamin;
    $nama_prodi       = $request->nama_prodi;
    $kode_prodi       = $request->kode_prodi;
    $nama_fakultas    = $request->nama_fakultas;
    $kode_fakultas    = $request->kode_fakultas;
    $jenjang          = $request->jenjang;
    $email            = $request->email;
    $no_telp          = $request->no_telp;
    $tahun_angkatan   = $request->tahun_angkatan;
    $semester         = $request->semester;
    $keterangan       = $request->keterangan;
    $jenis_pengajuan  = $request->jenis_pengajuan;
    $status_pengajuan = $request->status_pengajuan;
    // $file_pengajuan   = $request->jenis_pengajuan == '2' ? $request->file('upload_file')->store('file_pengajuan') : null;

    if($request->hasFile('upload_file'))
    {
      $file_pengajuan = $request->file('upload_file');
      $original_name  = trim($file_pengajuan->getClientOriginalName(), '.pdf');
      $original_ext   = $file_pengajuan->getClientOriginalExtension();
      $file_name      = $original_name. '_'. date('dmY') . $nim . '.' . $original_ext;
      $new_file_name  = 'file_pengajuan/'.$original_name. '_'. date('dmY') . $nim . '.' . $original_ext;
      $store          = $file_pengajuan->storeAs('file_pengajuan', $file_name);
    }

    if(session('user_cmode') == config('constants.users.prodi'))
    {
      $no_surat_prodi   = $request->no_surat_prodi;
    }
    else
    {
      $no_surat_prodi = null;
    }

    // dd($no_surat_prodi);

    try {
      DB::beginTransaction();

      $store = PengajuanMhs::updateOrcreate([
        'nim'              => $nim,
        'nama'             => $nama,
        'pa'               => $pa,
        'jenis_kelamin'    => $jenis_kelamin,
        'nama_prodi'       => $nama_prodi,
        'kode_prodi'       => $kode_prodi,
        'nama_fakultas'    => $nama_fakultas,
        'kode_fakultas'    => $kode_fakultas,
        'jenjang'          => $jenjang,
        'email'            => $email,
        'no_telp'          => $no_telp,
        'tahun_angkatan'   => $tahun_angkatan,
        'semester'         => $semester,
        'keterangan'       => $keterangan,
        'jenis_pengajuan'  => $jenis_pengajuan,
        'status_pengajuan' => $status_pengajuan,
      ]);

      $pengajuanMhs = PengajuanMhs::where('nim', $nim)->get();

      foreach ($pengajuanMhs as $pengajuan) {
        $id              = $pengajuan->id;
        $nim             = $pengajuan->nim;
        $jenis_pengajuan = $pengajuan->jenis_pengajuan;
      }

      $create_id = ['pengajuan_mhs_id' => $id,'nim' => $nim];

      // create user data surat & file pengajuan
      $add_id_surat = DB::table('ref_surat')->updateOrInsert($create_id, ['no_surat_prodi'=> $no_surat_prodi]);

      $add_id_file  = DB::table('ref_file_pengajuan')->updateOrInsert($create_id, ['file_pengajuan_md'=> $new_file_name]);

      $add_history = HistoryPengajuan::updateOrCreate(
        [
          'id_pengajuan'     => $id,
          'jenis_pengajuan'  => $jenis_pengajuan
        ],
        [
          'v_mode'           => trim(session('user_cmode')),
          'status_pengajuan' => $status_pengajuan
        ]
      );

      $pengajuanMhs = json_decode($pengajuanMhs);
      // Mail::to($email)->send(new Pengajuan($pengajuanMhs));

      DB::commit();

      if($jenis_pengajuan !== 2) {
        return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('success', 'Permohonan Cuti Diajukan.');
      }
      else {
        return redirect('data-pengajuan-mhs/md')->with('toast_success', 'Permohonan Pengunduran Diri Berhasil Diajukan');
        // return response()->json(['success' => 'Data submitted successfully', 'file' => $file_pengajuan]);
      }

    }
    catch (Exception $err) {
      DB::rollBack();
      // dd($err->errorInfo);
      dd($err);
      // return back()->with('toast_error', 'Permohonan cuti gagal diajukan, terjadi kesalahan.'. '<br>'.  ($err->errorInfo[2] = '<span class="text-danger"> Email sudah terdaftar!</span>'));
    }
  }

  public function show($nim)
  {
    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }

    $arrData = [
      'title'               => 'Status Pengajuan Cuti',
      'active'              => 'Home',
      'subtitle'            => null,
      'status_cuti_active'  => 'active',
    ];

    // dd($arrData);

    return view('pengajuan.pengajuan_cuti.status', $arrData);
  }

  public function edit($id)
  {

  }

  public function update(Request $request, $id)
  {
    $no_telp        = $request->no_telp;
    $tahun_angkatan = $request->tahun_angkatan;
    $semester       = $request->semester;
    $keterangan     = $request->keterangan;

    $update = PengajuanMhs::where('id', $id)->update([
      'no_telp'         => $no_telp,
      'tahun_angkatan'  => $tahun_angkatan,
      'semester'        => $semester,
      'keterangan'      => $keterangan,
    ]);

    if ($update) {
      return redirect('/pengajuan-mhs/status/' . base64_encode(session('user_username')))->with('success', 'Data berhasil diubah.');
    }
    else {
      return back()->with('toast_error', 'Data gagal diubah.');
    }

  }

  public function destroy($id)
  {
    $cuti   = PengajuanMhs::findOrFail($id)->delete();
    $surat  = DB::table('ref_surat')->where('id', $id)->delete();
    $file   = DB::table('ref_file_pengajuan')->where('id', $id)->delete();
    // dd($cuti);
    // $cuti   ->delete();
    // $surat  ->  delete();
    // $file   ->  delete();

    return back()->with('success', 'Pengajuan Cuti Batal Diajukan.');
  }
}
