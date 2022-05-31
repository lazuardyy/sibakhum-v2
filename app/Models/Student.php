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
  // protected $with = ['dosen','detailCutiMhs'];

  public function detailCutiMhs () {
    return $this -> hasMany(DetailCutiMhs::class, 'nim');
  }

  public function faculty ()
  {
    return $this -> belongsTo(Faculty::class, 'faculty_id');
  }
}
