<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
  use HasFactory;

  protected $table = 'pengajuan_cuti';
  protected $primaryKey = 'id';

  // protected $fillable = [
  //   'NIM',
  //   'Nama',
  //   'Jenis_Kelamin',
  //   'Tahun_Angkatan',
  // ];

  protected $guarded = ['id'];
  protected $dates= ['created_at'];
  protected $with = ['studyProgram', 'refStatusPengajuan'];

  public function studyProgram () {
    return $this -> belongsTo(StudyProgram::class, 'kode_prodi', 'kode_prodi');
  }

  public function faculty ()
  {
    return $this -> belongsTo(Faculty::class, 'kode_fakultas', 'kode_fakultas');
  }

  public function detailCutiMhs ()
  {
    return $this -> hasOne(DetailCutiMhs::class, 'nim', 'nim');
  }

  // public function refJenisPengajuan ()
  // {
  //   return $this -> belongsTo(RefJenisPengajuan::class, 'jenis_pengajuan', 'id');
  // }

  public function refStatusPengajuan ()
  {
    return $this -> belongsTo(RefStatusPengajuan::class, 'status_pengajuan', 'id');
  }
}
