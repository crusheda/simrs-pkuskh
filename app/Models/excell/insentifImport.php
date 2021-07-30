<?php

namespace App\Models\excell;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class insentifImport extends Model
{
    protected $table = 'insentif_kehadiran';
    public $timestamps = true;
    use SoftDeletes;
}