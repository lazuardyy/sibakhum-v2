<?php

namespace App\Http\Controllers\Fakultas;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengunduranDiri;
use App\Models\PengajuanMhs;
use App\Mail\Pengajuan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\HistoryPengajuan;
use PhpParser\Node\Stmt\TryCatch;

class PengunduranDiriController extends Controller
{
  public function create()
  {
    $user  = session('user_name');
    $mode  = session('user_mode');
    $cmode = session('user_cmode');

    if (!Session::has('isLoggedIn')) {
      return redirect()->to('login');
    }
    elseif($cmode !== config('constants.users.fakultas')) {
      return redirect()->to('/home');
    }

    $pengajuan_md = PengunduranDiri::where('nim', session('user_username'))->get();
    foreach ($pengajuan_md as $md) {
      $status_md = $md->status_pengajuan;
    }

    $pengajuan_cuti = PengajuanMhs::where('nim', session('user_username'))->get();
    foreach ($pengajuan_cuti as $cuti) {
      $status_cuti = $cuti->status_pengajuan;
    }

    if(isset($status_md) === false || isset($status_md) !== 4){
      if (isset($status_cuti)) {
        if($status_cuti !== 4 && $status_cuti !== 21) {
          return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan cuti!');
        }
        // else {
        //   return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengundurkan diri dari UNJ!');
        // }
        // return redirect('/pengajuan-cuti/status/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan permohonan cuti!');
      }
      else if(isset($status_md)) {
        if($status_md !== 4) {
          return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('warning', 'Maaf anda sedang mengajukan pengunduran diri!');
        }
        else {
          return redirect('/pengunduran-diri/' . base64_encode(session('user_username')))->with('success', 'Maaf anda sudah mengundurkan diri dari UNJ!');
        }
      }
    }

    $datas = array(
      [
        'id' => 1,
        'title' => 'NIM',
        'type' => 'text',
        'typeInput' => 'nim',
        'placeholder' => 'Masukkan NIM kamu',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 2,
        'title' => 'Nama Lengkap',
        'type' => 'text',
        'typeInput' => 'nama',
        'placeholder' => 'Masukkan nama lengkap kamu',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 3,
        'title' => 'Jenis Kelamin',
        'type' => 'text',
        'typeInput' => 'jenis_kelamin',
        'placeholder' => '',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 4,
        'title' => 'Fakultas',
        'type' => 'text',
        'typeInput' => 'nama_fakultas',
        'placeholder' => '',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 5,
        'title' => 'Program Studi',
        'type' => 'text',
        'typeInput' => 'nama_prodi',
        'placeholder' => '',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 6,
        'title' => 'Jenjang',
        'type' => 'text',
        'typeInput' => 'jenjang',
        'placeholder' => '',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 7,
        'title' => 'Angkatan',
        'type' => 'number',
        'typeInput' => 'tahun_angkatan',
        'placeholder' => 'Masukkan tahun masuk universitas',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 8,
        'title' => 'Pembimbing Akademik',
        'type' => 'text',
        'typeInput' => 'pa',
        'placeholder' => 'Masukkan NIP pembimbing akademik',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 9,
        'title' => 'Email',
        'type' => 'email',
        'typeInput' => 'email',
        'placeholder' => 'Masukkan google mail (gmail) kamu',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 10,
        'title' => 'No. Telp',
        'type' => 'tel',
        'typeInput' => 'no_telp',
        'placeholder' => 'Masukkan nomor telephone aktif',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 11,
        'title' => 'Semester',
        'type' => 'number',
        'typeInput' => 'semester',
        'placeholder' => '',
        'note' => '',
        'value' => '',
      ],
      [
        'id' => 12,
        'title' => 'Upload File Pengajuan',
        'type' => 'file',
        'typeInput' => 'upload_file',
        'placeholder' => '',
        'note' => 'Ukuran maksimal 2mb',
        'value' => '',
      ],
      [
        'id' => 13,
        'title' => 'Keterangan',
        'type' => 'textarea',
        'typeInput' => 'keterangan',
        'placeholder' => 'Jelaskan alasan pengunduran diri',
        'note' => '',
        'value' => '',
      ],
    );

    $arrData = [
      'title'     => 'Form Pengunduran Diri',
      'subtitle'  => 'Form Pengunduran Diri',
      'active'    => 'Home',
      'md_active' => 'active',

      'datas'     => $datas
    ];

    return view('pengajuan.pengunduran_diri.create', $arrData);
  }
}
