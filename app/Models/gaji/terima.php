<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class terima extends Model
{
    protected $table = 'gaji_terima';
    public $timestamps = true;
    use SoftDeletes;
}
