<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefStatusPengajuan extends Model
{
    use HasFactory;

    protected $table = 'ref_status_pengajuan';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    // public function refJenisPengajuan () {
    //   return $this->hasMany(RefJenisPengajuan::class, 'jenis_pengajuan', 'jenis_pengajuan');
    // }

    public function pengajuanMhs () {
      return $this->hasMany(PengajuanMhs::class, 'status_pengajuan', 'id');
    }

    public function pengunduranDiri () {
      return $this->hasMany(PengunduranDiri::class, 'status_pengajuan', 'id');
    }

    public function histories () {
      return $this->hasMany(HistoryPengajuan::class, 'status_pengajuan', 'id');
    }
}
