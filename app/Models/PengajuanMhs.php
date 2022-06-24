<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanMhs extends Model
{
  use HasFactory;

  protected $table = 'pengajuan_mhs';
  protected $primaryKey = 'id';

  // protected $fillable = [
  //   'NIM',
  //   'Nama',
  //   'Jenis_Kelamin',
  //   'Tahun_Angkatan',
  // ];

  protected $guarded = ['id'];
  // protected $dates= ['created_at', 'updated_at'];
  protected $with = ['studyProgram', 'refStatusPengajuan', 'histories'];

  public function studyProgram () {
    return $this -> belongsTo(StudyProgram::class, 'kode_prodi', 'kode_prodi');
  }

  public function refStatusPengajuan ()
  {
    return $this -> belongsTo(RefStatusPengajuan::class, 'status_pengajuan', 'id');
  }

  public function histories ()
  {
    return $this -> HasMany(HistoryPengajuan::class, 'id', 'id_pengajuan');
  }
}
