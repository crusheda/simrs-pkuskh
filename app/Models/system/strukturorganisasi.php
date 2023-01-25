<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class strukturorganisasi extends Model
{
    protected $table = 'struktur_organisasi';
    public $timestamps = true;
    use SoftDeletes;
}
