<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukaPeriode extends Model
{
  use HasFactory;

  protected $table = 'ref_periode';
  protected $primaryKey = 'id';
  protected $guarded = ['id'];

  public static function checkOpenPeriode()
  {
    $current_time =  date('Y-m-d H:i:s');
    // dd($current_time);
    $data = self::where('start_date', '<=', $current_time)
    ->where('end_date', '>=', $current_time)
    ->where('aktif', '1')
    ->first();
    // ->get();
    // dd($data);

    return $data;
  }

}
