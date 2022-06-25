<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPengajuan extends Model
{
    use HasFactory;

    protected $table = 'history_pengajuan';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $with = ['pengajuanMhs', 'pengunduranDiri'];

    public function pengajuanMhs ()
    {
      return $this -> belongsTo(PengajuanMhs::class, 'id_pengajuan', 'id');
    }

    public function pengunduranDiri ()
    {
      return $this -> belongsTo(PengunduranDiri::class, 'id_pengajuan', 'id');
    }

    public function refStatusPengajuan ()
    {
      return $this -> belongsTo(RefStatusPengajuan::class, 'status_pengajuan', 'id');
    }
}
