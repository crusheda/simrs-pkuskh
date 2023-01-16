<?php

namespace App\Models\tu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kdsuratkeluar extends Model
{
    protected $table = 'tu_kd_surat_keluar';
    public $timestamps = true;
    use SoftDeletes;
}
