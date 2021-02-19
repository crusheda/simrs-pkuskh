<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class absensi extends Model
{
    protected $table = 'absensi';
    public $timestamps = true;
    use SoftDeletes;
}
