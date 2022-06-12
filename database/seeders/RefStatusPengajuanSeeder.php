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
        'keterangan_cuti' => 'Mengajukan Cuti Kuliah',
        'keterangan_md' =>'Mengajukan Pengunduran Diri'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 1,
        // 'jenis_pengajuan' => 2,
        'status_pengajuan_cuti' => 'Disetujui oleh pembimbing akademik prodi',
        'status_pengunduran_diri' => 'Disetujui oleh pembimbing akademik prodi',
        'keterangan_cuti' => 'Dalam Proses Administrasi Akademik Prodi',
        'keterangan_md' => 'Dalam Proses Administrasi Akademik Prodi'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 2,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Disetujui oleh koordinator prodi',
        'status_pengunduran_diri' => 'Disetujui oleh koordinator prodi',
        'keterangan_cuti' => 'Dalam Proses Administrasi Akademik Prodi',
        'keterangan_md' =>'Dalam Proses Administrasi Akademik Prodi'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 3,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Disetujui oleh wakil dekan 1',
        'status_pengunduran_diri' => 'Disetujui oleh wakil dekan 1',
        'keterangan_cuti' => 'Dalam Proses Administrasi Akademik Fakultas',
        'keterangan_md' =>'Dalam Proses Administrasi Akademik Fakultas'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 4,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Disetujui oleh wakil rektor 1',
        'status_pengunduran_diri' => 'Disetujui oleh wakil rektor 1',
        'keterangan_cuti' => 'Dalam Proses Administrasi Akademik Universitas',
        'keterangan_md' =>'Dalam Proses Administrasi Akademik Universitas'
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
