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
      $this->call([
        RefModeSeeder::class,
        RefStatusPengajuanSeeder::class
      ]);
    }
}
