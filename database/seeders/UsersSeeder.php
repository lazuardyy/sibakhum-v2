<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $allDataFk = Http::get('http://103.8.12.212:36880/siakad_api/api/as400/fakultas/All');
      $dataFakultas = json_encode($allDataFk['isi']);
      $valuesFk = json_decode($dataFakultas);

      $allDataPr = Http::get('http://103.8.12.212:36880/siakad_api/api/as400/programStudi/All');
      $dataProdi = json_encode($allDataPr['isi']);
      $valuesPr = json_decode($dataProdi);

      DB::table('users')->insert([
        'username' => 'SUPERADMIN',
        'password' => Hash::make('hellosuperadmin'),
        'confirm_password' => Hash::make('hellosuperadmin'),
        'role' => 'superAdmin',
      ]);

      DB::table('users')->insert([
        'username' => 'ADMIN',
        'password' => Hash::make('helloadmin'),
        'confirm_password' => Hash::make('helloadmin'),
        'role' => 'admin',
      ]);

      DB::table('users')->insert([
        'username' => 'STUDENT',
        'password' => hash::make('hellostudent'),
        'confirm_password' => Hash::make('hellostudent'),
        'role' => 'student',
      ]);

      foreach($valuesFk as $index => $value )
      {
        DB::table('users')->insert([
          'username' => $value->wd1Fakultas,
          'password' => hash::make('hellofakultas'),
          'confirm_password' => Hash::make('hellofakultas'),
          'role' => 'faculty',
          'kodeFakultas' => $value->kodeFakultas,
          'nidn' => $value->wd1Fakultas,
        ]);
      };

      foreach($valuesPr as $index => $value )
      {
        DB::table('users')->insert([
          'username' => $value->KoordProdi,
          'password' => hash::make('hellokoor'),
          'confirm_password' => Hash::make('hellokoor'),
          'role' => 'dosen',
          // 'kodeFakultas' => $value->kodeFakProdi,
          'kodeProdi' => $value->kodeProdi,
          'nidn' => $value->KoordProdi,
        ]);
      };
    }
}
