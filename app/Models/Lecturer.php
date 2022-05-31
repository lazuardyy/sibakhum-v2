<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
  use HasFactory;

  protected $guarded = ['id'];
  // protected $with = ['detailCutiMhs'];

  public function detailCutiMhs () {
    return $this->hasMany(DetailCutiMhs::class, 'nidn');
  }
}
