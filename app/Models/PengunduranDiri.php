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
    protected $with = ['studyProgram', 'refStatusPengajuan', 'histories'];
    // protected $dates= ['created_at', 'updated_at'];

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
