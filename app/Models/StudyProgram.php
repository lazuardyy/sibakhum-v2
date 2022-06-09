<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    public function pengajuanCuti () {
      return $this->hasMany(PengajuanCuti::class, 'kode_prodi', 'kode_prodi');
    }

    public function detailCutiMhs () {
      return $this->hasMany(DetailCutiMhs::class, 'nidn', 'nidn');
    }

    public function faculty ()
    {
      return $this->belongsTo(Faculty::class, 'kode_fakultas', 'kode_fakultas');
    }
}
