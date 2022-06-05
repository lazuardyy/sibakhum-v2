<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $response = Http::get('http://103.8.12.212:36880/siakad_api/api/as400/programStudi/All');
      $dataProdi = json_encode($response['isi']);
      $values = json_decode($dataProdi);

      foreach($values as $index => $value )
      {
        DB::table('study_programs')->insert([
          'kodeFakultas' => $value->kodeFakProdi,
          'kodeProdi' => $value->kodeProdi,
          'namaProdi' => $value->namaProdi,
          'jenjang' => $value->jenjangProdi,
          'nidn' => $value->KoordProdi,
          'jabatan' => 'koordinator prodi',
        ]);
      };


      // db prodi fip
      // DB::table('study_programs')->insert([
      //   'prodi_id' => 101,
      //   'faculty_id' => 1,
      //   'name' => 'Bimbingan Konseling',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 102,
      //   'faculty_id' => 1,
      //   'name' => 'Manajemen Pendidikan',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 103,
      //   'faculty_id' => 1,
      //   'name' => 'Pendidikan Anak Usia Dini',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 104,
      //   'faculty_id' => 1,
      //   'name' => 'Pendidikan Guru Sekolah Dasar',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 105,
      //   'faculty_id' => 1,
      //   'name' => 'Pendidikan Luar Biasa',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 106,
      //   'faculty_id' => 1,
      //   'name' => 'Pendidikan Luar Sekolah',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 107,
      //   'faculty_id' => 1,
      //   'name' => 'Teknologi Pendidikan',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 108,
      //   'faculty_id' => 1,
      //   'name' => 'Bimbingan Konseling',
      //   'jenjang' => 'S2',
      // ]);

      // // db prodi fbs
      // DB::table('study_programs')->insert([
      //   'prodi_id' => 201,
      //   'faculty_id' => 2,
      //   'name' => 'Bahasa dan Sastra Indonesia',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 202,
      //   'faculty_id' => 2,
      //   'name' => 'Bahasa dan Sastra Inggris',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 203,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Bahasa Arab',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 204,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Bahasa Indonesia',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 205,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Bahasa Inggris',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 206,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Bahasa Jepang',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 207,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Bahasa Jerman',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 208,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Bahasa Mandarin',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 209,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Bahasa Perancis',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 210,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Seni Musik',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 211,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Seni Rupa',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 212,
      //   'faculty_id' => 2,
      //   'name' => 'Pendidikan Seni Tari',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 213,
      //   'faculty_id' => 2,
      //   'name' => 'Magister Pendidikan Bahasa Inggris',
      //   'jenjang' => 'S2',
      // ]);

      // // db prodi fmipa
      // DB::table('study_programs')->insert([
      //   'prodi_id' => 301,
      //   'faculty_id' => 3,
      //   'name' => 'Biologi',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 302,
      //   'faculty_id' => 3,
      //   'name' => 'Fisika',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 303,
      //   'faculty_id' => 3,
      //   'name' => 'Kimia',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 304,
      //   'faculty_id' => 3,
      //   'name' => 'Matematika',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 305,
      //   'faculty_id' => 3,
      //   'name' => 'Pendidikan Biologi',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 306,
      //   'faculty_id' => 3,
      //   'name' => 'Pendidikan Fisika',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 307,
      //   'faculty_id' => 3,
      //   'name' => 'Pendidikan Kimia',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 308,
      //   'faculty_id' => 3,
      //   'name' => 'Pendidikan Matematika',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 309,
      //   'faculty_id' => 3,
      //   'name' => 'Statistika',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 310,
      //   'faculty_id' => 3,
      //   'name' => 'Pendidikan Biologi',
      //   'jenjang' => 'S2',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 311,
      //   'faculty_id' => 3,
      //   'name' => 'Pendidikan Fisika',
      //   'jenjang' => 'S2',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 312,
      //   'faculty_id' => 3,
      //   'name' => 'Pendidikan Kimia',
      //   'jenjang' => 'S2',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 313,
      //   'faculty_id' => 3,
      //   'name' => 'Pendidikan Matematika',
      //   'jenjang' => 'S2',
      // ]);

      // // db prodi fis
      // DB::table('study_programs')->insert([
      //   'prodi_id' => 401,
      //   'faculty_id' => 4,
      //   'name' => 'Hubungan Masyarakat',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 402,
      //   'faculty_id' => 4,
      //   'name' => 'Usaha Jasa Pariwisata',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 403,
      //   'faculty_id' => 4,
      //   'name' => 'Ilmu Agama Islam',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 404,
      //   'faculty_id' => 4,
      //   'name' => 'Pendidikan Geografi',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 405,
      //   'faculty_id' => 4,
      //   'name' => 'Pendidikan IPS',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 406,
      //   'faculty_id' => 4,
      //   'name' => 'Pendidikan Kewarganegaraan',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 407,
      //   'faculty_id' => 4,
      //   'name' => 'Pendidikan Sejarah',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 408,
      //   'faculty_id' => 4,
      //   'name' => 'Pendidikan Sosiologi',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 409,
      //   'faculty_id' => 4,
      //   'name' => 'Sosiologi Pembangunan',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 410,
      //   'faculty_id' => 4,
      //   'name' => 'Geografi',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 411,
      //   'faculty_id' => 4,
      //   'name' => 'Pendidikan Geografi',
      //   'jenjang' => 'S2',
      // ]);


      // // db prodi ft
      // DB::table('study_programs')->insert([
      //   'prodi_id' => 501,
      //   'faculty_id' => 5,
      //   'name' => 'Tata Boga',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 502,
      //   'faculty_id' => 5,
      //   'name' => 'Tata Busana',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 503,
      //   'faculty_id' => 5,
      //   'name' => 'Tata Rias',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 504,
      //   'faculty_id' => 5,
      //   'name' => 'Teknik Elektronika',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 505,
      //   'faculty_id' => 5,
      //   'name' => 'Teknik Mesin',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 506,
      //   'faculty_id' => 5,
      //   'name' => 'Teknik Sipil',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 507,
      //   'faculty_id' => 5,
      //   'name' => 'Transportasi',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 508,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Informatika',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 509,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Kesejahteraan Keluarga',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 510,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Tata Boga',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 511,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Tata Busana',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 512,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Tata Rias',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 513,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Teknik Elektro',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 514,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Teknik Elektronika',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 515,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Teknik Mesin',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 516,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Teknik Sipil',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 517,
      //   'faculty_id' => 5,
      //   'name' => 'Teknik Mesin',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 518,
      //   'faculty_id' => 5,
      //   'name' => 'Sistem dan Teknologi Informasi',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 519,
      //   'faculty_id' => 5,
      //   'name' => 'Rekayasa Keselamatan Kebakaran',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 520,
      //   'faculty_id' => 5,
      //   'name' => 'Pendidikan Teknologi Kejuruan',
      //   'jenjang' => 'S2',
      // ]);


      // // db prodi fio
      // DB::table('study_programs')->insert([
      //   'prodi_id' => 601,
      //   'faculty_id' => 6,
      //   'name' => 'Ilmu Keolahragaan',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 602,
      //   'faculty_id' => 6,
      //   'name' => 'Pendidikan Jasmani',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 603,
      //   'faculty_id' => 6,
      //   'name' => 'Pendidikan Kepelatihan',
      //   'jenjang' => 'S1',
      // ]);

      // // db prodi fe
      // DB::table('study_programs')->insert([
      //   'prodi_id' => 701,
      //   'faculty_id' => 7,
      //   'name' => 'Akuntansi',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 702,
      //   'faculty_id' => 7,
      //   'name' => 'Manajemen Pemasaran',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 703,
      //   'faculty_id' => 7,
      //   'name' => 'Sekretaris',
      //   'jenjang' => 'D3',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 704,
      //   'faculty_id' => 7,
      //   'name' => 'Akuntansi',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 705,
      //   'faculty_id' => 7,
      //   'name' => 'Manajemen',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 706,
      //   'faculty_id' => 7,
      //   'name' => 'Pendidikan Administrasi Perkantoran',
      //   'jenjang' => 'S1',
      // ]);


      // DB::table('study_programs')->insert([
      //   'prodi_id' => 707,
      //   'faculty_id' => 7,
      //   'name' => 'Pendidikan Ekonomi',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 708,
      //   'faculty_id' => 7,
      //   'name' => 'Pendidikan Tata Niaga',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 709,
      //   'faculty_id' => 7,
      //   'name' => 'Bisnis Digital',
      //   'jenjang' => 'S1',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 710,
      //   'faculty_id' => 7,
      //   'name' => 'Magister Manajemen',
      //   'jenjang' => 'S2',
      // ]);

      // DB::table('study_programs')->insert([
      //   'prodi_id' => 711,
      //   'faculty_id' => 7,
      //   'name' => 'Magister Akuntansi',
      //   'jenjang' => 'S2',
      // ]);

      // // db prodi fppsi
      // DB::table('study_programs')->insert([
      //   'prodi_id' => 801,
      //   'faculty_id' => 8,
      //   'name' => 'Psikologi',
      //   'jenjang' => 'S1',
      // ]);

    }
}
