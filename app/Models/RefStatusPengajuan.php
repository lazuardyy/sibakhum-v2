<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefStatusPengajuan extends Model
{
    use HasFactory;

    protected $table = 'ref_status_pengajuan';
    protected $primaryKey = 'id';

    // public function refJenisPengajuan () {
    //   return $this->hasMany(RefJenisPengajuan::class, 'jenis_pengajuan', 'jenis_pengajuan');
    // }

    public function pengajuanCuti () {
      return $this->hasMany(PengajuanCuti::class, 'status_pengajuan', 'id');
    }

    public function pengunduranDiri () {
      return $this->hasMany(PengunduranDiri::class, 'status_pengajuan', 'id');
    }
}
