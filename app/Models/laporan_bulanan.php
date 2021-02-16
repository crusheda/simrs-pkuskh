<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class laporan_bulanan extends Model
{
    protected $table = 'laporan_bulanan';
    public $timestamps = true;
    use SoftDeletes;
}
