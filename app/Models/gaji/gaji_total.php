<?php

namespace App\Models\gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gaji_total extends Model
{
    protected $table = 'gaji_total';
    public $timestamps = true;
    use SoftDeletes;
}
