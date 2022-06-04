<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\DetailCutiMhs;
use App\Models\Faculty;
// use App\Models\StudyProgram;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $response = Http::get('http://103.8.12.212:36880/siakad_api/api/as400/fakultas/All');
        $dataFakultas = json_encode($response['isi']);
        $values = json_decode($dataFakultas);

        // User::create([
        //   'username' => 'SUPERADMIN',
        //   'password' => Hash::make('hellosuperadmin'),
        //   'confirm_password' => Hash::make('hellosuperadmin'),
        //   'role' => 'superAdmin',
        // ]);

        // User::create([
        //   'username' => 'ADMIN',
        //   'password' => Hash::make('helloadmin'),
        //   'confirm_password' => Hash::make('helloadmin'),
        //   'role' => 'admin',
        // ]);

        // User::create([
        //   'username' => 'STUDENT',
        //   'password' => hash::make('hellostudent'),
        //   'confirm_password' => Hash::make('hellostudent'),
        //   'role' => 'student',
        // ]);

        // User::create([
        //   'username' => 'LECTURER',
        //   'password' => hash::make('hellodosen'),
        //   'confirm_password' => Hash::make('hellodosen'),
        //   'role' => 'dosen',
        //   'nidn' => '123456789',
        // ]);

        // User::create([
        //   'username' => '1701618056',
        //   'password' => hash::make('hellofakultas'),
        //   'confirm_password' => Hash::make('hellofakultas'),
        //   'role' => 'faculty',
        //   'kodeFakultas' => 1,
        // ]);

        // User::create([
        //   'username' => '1701618088',
        //   'password' => hash::make('hellofakultas'),
        //   'confirm_password' => Hash::make('hellofakultas'),
        //   'role' => 'faculty',
        //   'kodeFakultas' => 7,
        // ]);

        // User::create([
        //   'username' => '1501618088',
        //   'password' => hash::make('hellofakultas'),
        //   'confirm_password' => Hash::make('hellofakultas'),
        //   'role' => 'faculty',
        //   'kodeFakultas' => 5,
        // ]);



        foreach($values as $index => $value )
        {
          Faculty::create([
            'kodeFakultas' => (int)$value->kodeFakultas,
            'namaFakultas' => $value->namaFakultas,
            'jabatan' => ($value->jabatanFakultas === 'Rektor' || $value->jabatanFakultas === 'Direktur') ? $value->jabatanFakultas : 'WD 1',
            'nidn' => $value->wd1Fakultas,
          ]);
        };

        Student::create([
          'nim' => '170602001',
          'nama' => 'Bambang',
          'kodeProdi' => '17016',
          'jenis_kelamin' => '1',
          'kodeFakultas' => '17',
          'no_telp' => '081212121212',
          'tahun_angkatan' => '2017',
          'keterangan' => 'Pengajuan Cuti',
        ]);

        foreach($values as $index => $value )
        {
          Lecturer::create([
            'nidn' => (int)$value->wd1Fakultas,
            'faculty_id' => $value->kodeFakultas,
            'jabatan' => $value->jabatanFakultas,
          ]);
        };

        $allDataPr = Http::get('http://103.8.12.212:36880/siakad_api/api/as400/programStudi/All');
        $dataProdi = json_encode($allDataPr['isi']);
        $valuesPr = json_decode($dataProdi);

        foreach($valuesPr as $value)
        {
          DetailCutiMhs::create([
            'nim' => '170602001',
            'kodeProdi' => $value->kodeProdi,
            'semester_cuti_mhs' => '4',
            // 'status_persetujuan_pa' => 'ditolak',
          ]);
        }
    }
}
