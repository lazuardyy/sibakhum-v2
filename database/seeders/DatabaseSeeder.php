<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\DetailCutiMhs;
use App\Models\Faculty;

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
        User::create([
          'username' => 'SUPERADMIN',
          'password' => Hash::make('hellosuperadmin'),
          'confirm_password' => Hash::make('hellosuperadmin'),
          'role' => 'superAdmin',
        ]);

        User::create([
          'username' => 'ADMIN',
          'password' => Hash::make('helloadmin'),
          'confirm_password' => Hash::make('helloadmin'),
          'role' => 'admin',
        ]);

        User::create([
          'username' => 'STUDENT',
          'password' => hash::make('hellostudent'),
          'confirm_password' => Hash::make('hellostudent'),
          'role' => 'student',
        ]);

        User::create([
          'username' => 'LECTURER',
          'password' => hash::make('hellodosen'),
          'confirm_password' => Hash::make('hellodosen'),
          'role' => 'dosen',
        ]);

        User::create([
          'username' => '1701618056',
          'password' => hash::make('hellofakultas'),
          'confirm_password' => Hash::make('hellofakultas'),
          'role' => 'faculty',
          'faculty_id' => 1,
        ]);

        User::create([
          'username' => '1701618088',
          'password' => hash::make('hellofakultas'),
          'confirm_password' => Hash::make('hellofakultas'),
          'role' => 'faculty',
          'faculty_id' => 7,
        ]);

        User::create([
          'username' => '1501618088',
          'password' => hash::make('hellofakultas'),
          'confirm_password' => Hash::make('hellofakultas'),
          'role' => 'faculty',
          'faculty_id' => 5,
        ]);

        Faculty::create([
          'name' => 'Fakultas Ilmu Pendidikan',
        ]);

        Faculty::create([
          'name' => 'Fakultas Bahasa dan Seni',
        ]);

        Faculty::create([
          'name' => 'Fakultas Matematikan dan Ilmu Pengetahuan Alam'
        ]);

        Faculty::create([
          'name' => 'Fakultas Ilmu Sosial'
        ]);

        Faculty::create([
          'name' => 'Fakultas Teknik',
        ]);

        Faculty::create([
          'name' => 'Fakultas Ilmu Olahraga',
        ]);

        Faculty::create([
          'name' => 'Fakultas Ekonomi',
        ]);

        Faculty::create([
          'name' => 'Fakultas Pendidikan Psikologi',
        ]);

        Student::create([
          'nim' => '170602001',
          'nama' => 'Bambang',
          'prodi' => 'Pendidikan Ekonomi',
          'jenis_kelamin' => '1',
          'faculty_id' => '7',
          'no_telp' => '081212121212',
          'tahun_angkatan' => '2017',
          'keterangan' => 'Pengajuan Cuti',
        ]);

        Lecturer::create([
          'nidn' => '123456789',
          'nama' => 'pembimbing akademik',
          'email' => 'pa@gmail.com',
          'no_telp' => '08123456789',
        ]);

        Lecturer::create([
          'nidn' => '345678901',
          'nama' => 'koorprodi',
          'email' => 'ko@gmail.com',
          'no_telp' => '08123456789',
        ]);

        Lecturer::create([
          'nidn' => '456789012',
          'nama' => 'wd 1',
          'email' => 'wd@gmail.com',
          'no_telp' => '08123456789',
        ]);

        Lecturer::create([
          'nidn' => '567890123',
          'nama' => 'wr 1',
          'email' => 'wr@gmail.com',
          'no_telp' => '08123456789',
        ]);

        DetailCutiMhs::create([
          'nim' => '170602001',
          'nidn' => '123456789',
          'semester_cuti_mhs' => '4',
          // 'status_persetujuan_pa' => 'ditolak',
        ]);
    }
}
