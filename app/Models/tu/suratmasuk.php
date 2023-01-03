<?php

namespace App\Models\tu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class suratmasuk extends Model
{
    protected $table = 'tu_surat_masuk';
    public $timestamps = true;
    use SoftDeletes;
}
