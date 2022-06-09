<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengunduranDiri extends Model
{
    use HasFactory;

    protected $table = 'pengunduran_diri';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
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

    public function refStatusPengajuan ()
    {
      return $this -> belongsTo(RefStatusPengajuan::class, 'status_pengajuan', 'id');
    }
}
