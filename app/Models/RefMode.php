<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefMode extends Model
{
    use HasFactory;

    protected $table = 'ref_modes';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $fillable = ['id', 'mode', 'active'];
}
