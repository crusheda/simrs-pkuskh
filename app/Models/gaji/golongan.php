<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class golongan extends Model
{
    protected $table = 'gaji_golongan';
    public $timestamps = true;
    use SoftDeletes;
}