<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class karyawan extends Model
{
    protected $table = 'karyawan';
    public $timestamps = true;
    use SoftDeletes;
}
