<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefSurat extends Model
{
    use HasFactory;

    protected $table = 'ref_surat';
    protected $guarded = ['id'];

    public function pengajuanMhs ()
    {
      return $this->belongsTo(PengajuanMhs::class);
    }
}
