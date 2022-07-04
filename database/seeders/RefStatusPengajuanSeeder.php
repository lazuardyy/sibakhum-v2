<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefStatusPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('ref_status_pengajuan')->insert([
        'id' => 0,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Mengajukan Cuti Kuliah',
        'status_pengunduran_diri' => 'Mengajukan Pengunduran Diri',
        'keterangan_cuti' => 'Silahkan konfirmasi ke Pembimbing Akademik',
        'keterangan_md' =>'Silahkan konfirmasi ke Pembimbing Akademik'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 1,
        // 'jenis_pengajuan' => 2,
        'status_pengajuan_cuti' => 'Disetujui oleh pembimbing akademik',
        'status_pengunduran_diri' => 'Disetujui oleh pembimbing akademik',
        'keterangan_cuti' => 'Dalam proses persetujuan Koordinator Prodi',
        'keterangan_md' => 'Dalam proses persetujuan Koordinator Prodi'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 2,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Disetujui oleh koordinator prodi',
        'status_pengunduran_diri' => 'Disetujui oleh koordinator prodi',
        'keterangan_cuti' => 'Dalam proses persetujuan Wakil Dekan 1',
        'keterangan_md' =>'Dalam proses persetujuan Wakil Dekan 1'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 3,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Disetujui oleh wakil dekan 1',
        'status_pengunduran_diri' => 'Disetujui oleh wakil dekan 1',
        'keterangan_cuti' => 'Dalam proses persetujuan Wakil Rektor 1',
        'keterangan_md' =>'Dalam proses persetujuan Wakil Rektor 1'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 4,
        'status_pengajuan_cuti' => 'Disetujui oleh wakil rektor 1',
        'status_pengunduran_diri' => 'Disetujui oleh wakil rektor 1',
        'keterangan_cuti' => 'Dalam Proses Administrasi Akademik Fakultas',
        'keterangan_md' =>'Dalam Proses Administrasi Akademik Fakultas'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 5,
        'status_pengajuan_cuti' => 'Data pengajuan selesai diproses Akademik Fakultas',
        'status_pengunduran_diri' => 'Data pengajuan selesai diproses Akademik Fakultas',
        'keterangan_cuti' => 'Data pengajuan diteruskan ke Bakhum',
        'keterangan_md' =>'Data pengajuan diteruskan ke Bakhum'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 6,
        'status_pengajuan_cuti' => 'Data pengajuan selesai diproses Bakhum',
        'status_pengunduran_diri' => 'Data pengajuan selesai diproses Bakhum',
        'keterangan_cuti' => 'Silahkan lakukan pembayaran cuti kuliah',
        'keterangan_md' =>'Menunggu surat keterangan pengunduran diri'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 7,
        'status_pengajuan_cuti' => 'Proses pengajuan cuti selesai',
        'status_pengunduran_diri' => 'Proses pengunduran diri selesai',
        'keterangan_cuti' => 'Silahkan download surat keterangan cuti kuliah',
        'keterangan_md' =>'Silahkan download surat keterangan pengunduran diri'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 21,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Ditolak oleh pembimbing akademik prodi',
        'status_pengunduran_diri' => 'Ditolak oleh pembimbing akademik prodi',
        'keterangan_cuti' => 'Tidak memenuhi syarat',
        'keterangan_md' =>'Tidak memenuhi syarat'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 22,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Ditolak oleh koordinator prodi',
        'status_pengunduran_diri' => 'Ditolak oleh koordinator prodi',
        'keterangan_cuti' => 'Tidak memenuhi syarat',
        'keterangan_md' =>'Tidak memenuhi syarat'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 23,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Ditolak oleh wakil dekan 1',
        'status_pengunduran_diri' => 'Ditolak oleh wakil dekan 1',
        'keterangan_cuti' => 'Tidak memenuhi syarat',
        'keterangan_md' =>'Tidak memenuhi syarat'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 24,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Ditolak oleh wakil rektor 1',
        'status_pengunduran_diri' => 'Ditolak oleh wakil rektor 1',
        'keterangan_cuti' => 'Tidak memenuhi syarat',
        'keterangan_md' =>'Tidak memenuhi syarat'
      ]);
    }
}
