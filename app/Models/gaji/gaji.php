<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gaji extends Model
{
    protected $table = 'gaji';
    public $timestamps = true;
    use SoftDeletes;
}
