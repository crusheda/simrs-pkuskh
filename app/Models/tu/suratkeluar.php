<?php

namespace App\Models\tu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class suratkeluar extends Model
{
    protected $table = 'tu_surat_keluar';
    public $timestamps = true;
    use SoftDeletes;
}
