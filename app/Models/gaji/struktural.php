<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class struktural extends Model
{
    protected $table = 'gaji_struktural';
    public $timestamps = true;
    use SoftDeletes;
}
