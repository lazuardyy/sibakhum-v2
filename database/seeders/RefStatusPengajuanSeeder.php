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
        'status_pengajuan_cuti' => 'Diproses oleh akademik fakultas ke dekan',
        'status_pengunduran_diri' => 'Diproses oleh akademik fakultas ke dekan',
        'keterangan_cuti' => 'Dalam Proses Administrasi Akademik Fakultas',
        'keterangan_md' => 'Dalam Proses Administrasi Akademik Fakultas'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 2,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Disetujui Oleh Dekan Fakultas',
        'status_pengunduran_diri' => 'Disetujui Oleh Dekan Fakultas',
        'keterangan_cuti' => 'Telah disetujui oleh Dekan Fakultas',
        'keterangan_md' =>'Telah disetujui oleh Dekan Fakultas'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 3,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Diproses Oleh Kantor Wakil Rektor 1',
        'status_pengunduran_diri' => 'Diproses Oleh Kantor Wakil Rektor 1',
        'keterangan_cuti' => 'Dalam Proses Kantor WR 1',
        'keterangan_md' =>'Dalam Proses Kantor WR 1'
      ]);

      DB::table('ref_status_pengajuan')->insert([
        'id' => 4,
        // 'jenis_pengajuan' => 1,
        'status_pengajuan_cuti' => 'Disetujui Oleh WR 1',
        'status_pengunduran_diri' => 'Disetujui Oleh WR 1',
        'keterangan_cuti' => 'Telah disetujui dan di SK kan oleh WR 1',
        'keterangan_md' =>'Telah disetujui dan di SK kan oleh WR 1'
      ]);
    }
}
