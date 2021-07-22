<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class fungsional extends Model
{
    protected $table = 'gaji_fungsional';
    public $timestamps = true;
    use SoftDeletes;
}
