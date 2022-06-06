<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefMode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $modes = [
        'super admin',
        'program studi',
        'fakultas',
        'bakhum',
        'mahasiswa',
        'keuangan',
        'upt tik',
        'dekanat',
        'pimpinan unj',
      ];

      DB::table('ref_modes')->insert([
        'id' => 1,
        'mode' => 'super admin',
        'active' => 1,
      ]);
      DB::table('ref_modes')->insert([
        'id' => 2,
        'mode' => 'program studi',
        'active' => 1,
      ]);
      DB::table('ref_modes')->insert([
        'id' => 3,
        'mode' => 'fakultas',
        'active' => 1,
      ]);
      DB::table('ref_modes')->insert([
        'id' => 4,
        'mode' => 'bakhum',
        'active' => 1,
      ]);
      DB::table('ref_modes')->insert([
        'id' => 9,
        'mode' => 'mahasiswa',
        'active' => 1,
      ]);
      DB::table('ref_modes')->insert([
        'id' => 11,
        'mode' => 'keuangan',
        'active' => 1,
      ]);
      DB::table('ref_modes')->insert([
        'id' => 13,
        'mode' => 'upt tik',
        'active' => 1,
      ]);
      DB::table('ref_modes')->insert([
        'id' => 14,
        'mode' => 'dekanat',
        'active' => 1,
      ]);
      DB::table('ref_modes')->insert([
        'id' => 20,
        'mode' => 'pimpinan unj',
        'active' => 1,
      ]);
    }
}
