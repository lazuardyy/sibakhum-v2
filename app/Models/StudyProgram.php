<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    use HasFactory;

    public function students () {
      return $this->hasMany(Student::class, 'kodeProdi', 'kodeProdi');
    }

    public function detailCutiMhs () {
      return $this->hasMany(DetailCutiMhs::class, 'nidn', 'nidn');
    }

    public function faculty ()
    {
      return $this->belongsTo(Faculty::class, 'kodeFakultas', 'kodeFakultas');
    }
}
