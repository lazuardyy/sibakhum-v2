<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use HasFactory;

  protected $table = 'students';

  // protected $fillable = [
  //   'NIM',
  //   'Nama',
  //   'Jenis_Kelamin',
  //   'Tahun_Angkatan',
  // ];

  protected $guarded = ['id'];
  protected $dates= ['created_at'];
  protected $with = 'detailCutiMhs';

  public function studyProgram () {
    return $this -> belongsTo(StudyProgram::class, 'kodeProdi', 'kodeProdi');
  }

  public function faculty ()
  {
    return $this -> belongsTo(Faculty::class, 'kodeFakultas', 'kodeFakultas');
  }

  public function detailCutiMhs ()
  {
    return $this -> hasOne(DetailCutiMhs::class, 'nim', 'nim');
  }
}
