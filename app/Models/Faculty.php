<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';
    protected $with = ['students', 'studyPrograms'];


    // public function detailCutiMhs()
    // {
    //   return $this->belongsTo(DetailCutiMhs::class, 'nidn');
    // }

    public function students()
    {
      return $this->hasMany(Student::class, 'kodeFakultas', 'kodeFakultas');
    }

    public function studyPrograms()
    {
      return $this->hasMany(StudyProgram::class, 'kodeFakultas', 'kodeFakultas');
    }
}
