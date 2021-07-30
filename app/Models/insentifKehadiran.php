<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class insentifKehadiran extends Model
{
    protected $table = 'insentif_kehadiran';
    protected $fillable = ['id','id_finger','nama','unit','absen1','absen2','absen3'];
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
