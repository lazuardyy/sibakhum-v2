<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefFilePengajuan extends Model
{
    use HasFactory;

    protected $table = 'ref_file_pengajuan';
    protected $guarded = 'id';

    public function pengajuanMhs ()
    {
      return $this->belongsTo(PengajuanMhs::class);
    }
}
