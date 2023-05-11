<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class laporan_bulanan_verif extends Model
{
    protected $table = 'laporan_bulanan_verif';
    public $timestamps = true;
    use SoftDeletes;
}
