<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Haruncpi\LaravelUserActivity\Traits\Loggable;

class rapat extends Model
{
    protected $table = 'rapat';
    protected $fillable = [
        'nama',
        'tanggal',
        'lokasi',
        'title',
        'filename'
    ];
    public $timestamps = true;
    use SoftDeletes;
    // use Loggable;
}
