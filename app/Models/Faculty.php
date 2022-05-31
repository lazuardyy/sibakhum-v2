<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';
    protected $with = 'students';


    // public function detailCutiMhs()
    // {
    //   return $this->belongsTo(DetailCutiMhs::class, 'nidn');
    // }

    public function students()
    {
      return $this->hasMany(Student::class, 'faculty_id');
    }
}
