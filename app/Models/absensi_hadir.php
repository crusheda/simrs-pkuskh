<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class absensi_hadir extends Model
{
    protected $table = 'absensi_hadir';
    public $timestamps = true;
    use SoftDeletes;
}
