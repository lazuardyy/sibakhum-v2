<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCutiMhs extends Model
{
  use HasFactory;

  protected $guarded = ['id'];
  // protected $with = ['students', 'lecturers'];

  public function students () {
    return $this -> belongsTo(PengajuanCuti::class, 'nim', 'nim');
    // return $this -> belongsTo(Cuti::class);
  }

  public function studyProgram () {
    return $this -> belongsTo(StudyProgram::class, 'nidn', 'nidn');
  }
}
